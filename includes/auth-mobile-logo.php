<?php if ( ! defined( 'ABSPATH' ) ) exit;
/* ⚠️ MA CHET — 05/09/2026: KHONG file nao nap file nay. page-login.php,
   page-register.php va page-forgot-password.php chi include auth-styles.php
   va auth-scripts.php; HTML that cua ca ba trang khong he co class duoi day.
   Trang dang nhap dung chu thay logo (.auth-logo{display:none} o page-login.php).
   Sua kich thuoc trong file nay KHONG doi gi tren site — da mac bay dung mot lan. */ ?>
<div class="auth-mobile-logo">
    <?php $ln_icon = get_option('sitetop_widget_icon',''); ?>
    <a href="<?php echo esc_url( home_url() ); ?>">
        <img src="<?php echo esc_url( $ln_icon ?: sitetop_logo_url('sitetop-logo.png') ); ?>" width="30" height="30" alt="" style="margin-right:6px;border-radius:50%">
        SiteTop.one
    </a>
</div>
