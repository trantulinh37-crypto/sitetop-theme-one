<?php
/* Chốt chặn "đúng URL mới cho lấy mã" — sitetop_campaign_allows_url() trong functions.php.

   05/09/2026 chủ site NỚI LỎNG: chỉ so DOMAIN, bỏ qua đường dẫn. Camp đặt
   https://test.com/ thì user đứng ở https://test.com/abc/ cũng hợp lệ; https://test.vn/
   vẫn bị chặn. Trước đó so cả host lẫn path nên phải vào đúng y nguyên URL.

   Đây là luật quyết định AI ĐƯỢC TRẢ TIỀN, nên chốt lại bằng test: nới quá tay thì mất
   tiền oan, siết lại thì user làm đúng vẫn bị chặn.

   Bản dưới là bản sao logic của functions.php (harness không nạp WordPress) — sửa bên
   kia thì sửa cả bên này. */

$host_of = function ( $url ) {
    $url = str_replace( array( "\xC2\xA0", "\xE2\x80\x8B", "\xE2\x80\x8C", "\xE2\x80\x8D", "\xEF\xBB\xBF" ), ' ', (string) $url );
    $host = parse_url( trim( $url ), PHP_URL_HOST );
    return $host ? preg_replace( '/^www\./', '', strtolower( $host ) ) : '';
};

$allows = function ( $dests, $current ) use ( $host_of ) {
    $h = $host_of( $current );
    if ( $h === '' ) return false;
    foreach ( (array) $dests as $u ) {
        if ( $host_of( $u ) === $h ) return true;
    }
    return false;
};

$camp = array( 'https://test.com/' );

// ── Đúng yêu cầu chủ site ────────────────────────────────────────────────
assert_true(  $allows( $camp, 'https://test.com/' ),        'Vao dung URL goc -> cho' );
assert_true(  $allows( $camp, 'https://test.com/abc/' ),    'Cung domain, khac duong dan -> CHO (day la phan noi long)' );
assert_true(  $allows( $camp, 'https://test.com/a/b/c?x=1#y' ), 'Duong dan sau + query + hash -> cho' );
assert_false( $allows( $camp, 'https://test.vn/' ),         'Khac domain -> CHAN' );

// ── www và chữ hoa phải coi như một ──────────────────────────────────────
assert_true(  $allows( $camp, 'https://www.test.com/abc' ), 'www.test.com = test.com' );
assert_true(  $allows( $camp, 'HTTPS://TEST.COM/ABC' ),     'Chu hoa -> van khop' );
assert_true(  $allows( array( 'https://www.test.com/x' ), 'https://test.com/y' ), 'Camp dat www, user vao khong www -> cho' );
assert_true(  $allows( $camp, 'http://test.com/abc' ),      'http vs https -> khong xet giao thuc' );

// ── Giữ hẹp: KHÔNG mở cho tên miền con ───────────────────────────────────
// Mở cho mọi tên miền con nghĩa là ai trỏ được một tên miền con là lấy được mã.
assert_false( $allows( $camp, 'https://blog.test.com/abc' ), 'Ten mien con -> CHAN' );
assert_false( $allows( $camp, 'https://test.com.evil.net/' ), 'Domain gia dinh duoi -> CHAN' );
assert_false( $allows( $camp, 'https://nottest.com/' ),      'Domain chua chuoi giong -> CHAN' );

// ── Camp nhiều URL đích ở nhiều domain ───────────────────────────────────
$nhieu = array( 'https://a.com/trang-1', 'https://b.org/muc/2' );
assert_true(  $allows( $nhieu, 'https://a.com/bat-ky' ), 'Khop domain thu nhat' );
assert_true(  $allows( $nhieu, 'https://b.org/khac' ),   'Khop domain thu hai' );
assert_false( $allows( $nhieu, 'https://c.net/' ),       'Khong domain nao khop -> CHAN' );

// ── Rác vô hình dán từ Word/Zalo không được làm hỏng so khớp ─────────────
assert_true( $allows( array( "  https://test.com/x\xC2\xA0" ), 'https://test.com/y' ), 'URL dich dinh khoang trang khong ngat -> van khop' );
assert_true( $allows( $camp, "\xEF\xBB\xBFhttps://test.com/z" ), 'URL hien tai dinh BOM -> van khop' );

// ── Đầu vào hỏng thì phải CHẶN, không được cho qua ───────────────────────
assert_false( $allows( $camp, '' ),           'URL rong -> CHAN' );
assert_false( $allows( $camp, 'khong-phai-url' ), 'Chuoi khong phai URL -> CHAN' );
assert_false( $allows( array(), 'https://test.com/' ), 'Camp khong co URL dich nao -> CHAN' );

echo "  ✓ campaign url match (so theo domain)\n";
