<?php
/* WIDGET .one PHẢI SỐNG CHUNG VỚI WIDGET .net TRÊN CÙNG MỘT TRANG — 17/09/2026.

   Hai site chạy cùng một gốc code. Web khách gắn cả top.js của sitetop.net lẫn sitetop.one
   vào footer. Bản cũ dùng TRÙNG TÊN với .net nên: widget nạp sau thấy khung của bên kia đã
   có liền bỏ qua (mất hẳn widget); trùng khoá localStorage làm phiên hai site ghi đè nhau;
   trùng hàm toàn cục làm bấm nút site này chạy hàm của site kia; trùng CSS làm màu nút site
   nạp sau đè lên cả nút site kia.

   QUY ƯỚC: .net giữ tiền tố gốc; .one dùng tno (ID/class/khoá/keyframes) và _sto (toàn cục).
   ĐỒNG BỘ CODE TỪ .net SANG .one PHẢI DỊCH TÊN — không dịch là test này đỏ.

   Ngoại lệ có chủ đích: 4 khoá tn_unlock_session / tn_unlock_time / tn_campaign_type /
   tn_unlock_active do page-unlock.php ghi trên CHÍNH tên miền sitetop.one — không bao giờ cùng
   tên miền với .net nên không va nhau; đổi một phía là đứt luồng. */

$__goc = dirname( __DIR__, 2 );
$__w   = file_get_contents( $__goc . '/widget.js.php' );
$__pu  = file_get_contents( $__goc . '/page-unlock.php' );
assert_true( $__w !== false && $__w !== '', 'Phai doc duoc widget.js.php' );

assert_true( strpos( $__w, "if(document.getElementById('tno-w'))return;" ) !== false,
    'Chot chong dung trung phai dung khung RIENG tno-w — dung khung cua .net la widget nap sau bi mat' );
assert_equals( 0, preg_match_all( '/(?<![A-Za-z0-9_$-])tn-[a-z0-9]/', $__w ),
    'Khong duoc con ID/class tien to cua .net trong widget .one' );

preg_match_all( '/(?<![A-Za-z0-9_$])tn_[a-z0-9_]+/', $__w, $__k );
$__la = array_diff( array_unique( $__k[0] ), array( 'tn_unlock_session', 'tn_unlock_time', 'tn_campaign_type', 'tn_unlock_active' ) );
assert_true( empty( $__la ), 'Khoa localStorage cua widget .one khong duoc trung .net: ' . implode( ',', $__la ) );
assert_true( strpos( $__w, "localStorage.setItem('tno_session_id'" ) !== false, 'Phien widget .one phai luu o tno_session_id' );
assert_true( strpos( $__w, "localStorage.setItem('tno_step2_waiting'" ) !== false, 'Co buoc 2 .one phai luu o tno_step2_waiting' );

assert_equals( 0, preg_match_all( '/(?<![A-Za-z0-9_$])_st[A-Z]/', $__w ),
    'Ham/bien toan cuc cua widget .one phai dung _sto — trung _st la bam nut site nay chay ham site kia' );
assert_true( strpos( $__w, 'window._stoWidgetClick=function' ) !== false, 'Phai co window._stoWidgetClick' );
assert_true( strpos( $__w, 'onclick="window._stoWidgetClick()"' ) !== false, 'Nut .one phai goi dung ham cua .one' );

assert_equals( 0, preg_match_all( '/@keyframes tn[A-Z]/', $__w ), 'Keyframes .one khong duoc trung .net' );
assert_true( strpos( $__w, '@keyframes tnoBtnPulse' ) !== false, 'Phai co keyframes tnoBtnPulse' );
assert_true( strpos( $__w, "'#tno-w{" ) !== false, 'CSS widget .one phai nham dung khung tno-w' );

assert_equals( 0, preg_match_all( '/onTurnstileLoad(?!SitetopOne)/', $__w ), 'Callback Turnstile .one khong duoc trung ten .net' );
assert_true( strpos( $__w, 'onload=onTurnstileLoadSitetopOne' ) !== false, 'Script Turnstile phai goi dung callback .one' );

// 4 khoá đi cặp với trang nhiệm vụ: widget đọc đúng tên mà page-unlock ghi
foreach ( array( 'tn_unlock_session', 'tn_unlock_time', 'tn_campaign_type' ) as $__kk ) {
    assert_true( strpos( $__w, "localStorage.getItem('$__kk')" ) !== false && strpos( $__pu, "localStorage.setItem('$__kk'" ) !== false,
        "Khoa $__kk phai giu nguyen o CA widget lan page-unlock — doi mot phia la dut luong" );
}
