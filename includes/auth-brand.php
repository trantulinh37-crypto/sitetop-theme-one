<?php if ( ! defined( 'ABSPATH' ) ) exit;
/* ⚠️ MA CHET — 05/09/2026: KHONG file nao nap file nay. page-login.php,
   page-register.php va page-forgot-password.php chi include auth-styles.php
   va auth-scripts.php; HTML that cua ca ba trang khong he co class duoi day.
   Trang dang nhap dung chu thay logo (.auth-logo{display:none} o page-login.php).
   Sua kich thuoc trong file nay KHONG doi gi tren site — da mac bay dung mot lan. */ ?>
<div class="auth-brand">
    <?php $ln_icon = get_option('sitetop_widget_icon',''); ?>
    <a href="<?php echo esc_url( home_url() ); ?>" class="auth-brand-logo">
        <img src="<?php echo esc_url( $ln_icon ?: sitetop_logo_url('sitetop-logo.png') ); ?>" width="31" height="31" alt="" style="margin-right:6px;border-radius:50%">
        SiteTop.one
    </a>
    <h1 id="brandTitle">Chia sẻ link.<br><span>Nhận thưởng.</span></h1>
    <p id="brandDesc">Nền tảng tăng traffic từ người dùng thật. Rút gọn link để kiếm tiền hoặc mua traffic chất lượng cho website của bạn.</p>

    <div class="auth-features" id="brandFeatures">
        <div class="auth-feat">
            <div class="auth-feat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#1E5EFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
            <div class="auth-feat-text">
                <h4>Rút tiền nhanh chóng</h4>
                <p>Thanh toán qua ngân hàng hoặc USDT, xử lý trong 24h</p>
            </div>
        </div>
        <div class="auth-feat">
            <div class="auth-feat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#1E5EFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
            <div class="auth-feat-text">
                <h4>Traffic người dùng thật</h4>
                <p>100% lượt truy cập từ người thật, chống gian lận tự động</p>
            </div>
        </div>
        <div class="auth-feat">
            <div class="auth-feat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#1E5EFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg></div>
            <div class="auth-feat-text">
                <h4>Thống kê chi tiết</h4>
                <p>Dashboard trực quan, theo dõi thu nhập và chiến dịch real-time</p>
            </div>
        </div>
    </div>
</div>
