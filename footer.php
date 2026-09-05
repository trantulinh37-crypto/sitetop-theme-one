<?php if (!defined('ABSPATH')) exit;
/* ⚠️ FILE NAY KHONG HIEN O DAU — kiem chung 05/09/2026.
   Chi index.php goi get_footer(), va chinh index.php co luat
   footer{display:none!important} (dong 26) de lam hero mot man hinh.
   Moi trang khac tu dung footer rieng <footer class="page-footer">.
   Vi vay sua kich thuoc/anh trong file nay KHONG doi gi tren site.
   Logo tron ma khach nhin thay o cuoi trang chu la NUT WIDGET (#tn-btn.tn-logo),
   khong phai logo footer. Dong "Copyright" tren trang chu la .ln-copyright
   trong index.php (chi co chu, khong co anh). */ ?>
<footer style="background:#0F172A;color:rgba(255,255,255,.4);padding:48px 0 32px;margin-top:48px">
<style>
/* Logo footer: giu 27px tren may tinh. Tren dien thoai logo 27px qua nho so voi
   chu SITETOP ben canh nen phong len 32px. Dat bang CSS chu khong sua thuoc tinh
   width/height: giu 27 o thuoc tinh thi trinh duyet biet ty le tu dau, khong bi
   giat bo cuc luc anh tai xong. Nguong 600px la nguong mobile chinh cua theme. */
.ft-logo{width:27px;height:27px}
@media(max-width:600px){.ft-logo{width:32px;height:32px}}
</style>
<div style="max-width:1200px;margin:0 auto;padding:0 24px">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:32px;margin-bottom:32px">
        <div style="max-width:320px">
            <?php $ft_icon = get_option('sitetop_widget_icon',''); ?>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px">
                <img class="ft-logo" src="<?php echo esc_url( $ft_icon ?: sitetop_logo_url('sitetop-logo.png') ); ?>" width="27" height="27" alt="" style="border-radius:50%">
                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:17px"><span style="color:#fff">SITE</span><span style="background:linear-gradient(120deg,#38BDF8,#7DD3FC);-webkit-background-clip:text;background-clip:text;color:transparent">TOP</span></span>
            </div>
            <p style="font-size:13px;line-height:1.7;color:rgba(255,255,255,.45)">Nền tảng trung gian kết nối người cung cấp traffic và doanh nghiệp cần đẩy SEO từ khóa lên top Google.</p>
        </div>
        <div style="display:flex;gap:48px;flex-wrap:wrap">
            <div>
                <div style="font-weight:700;font-size:13px;color:rgba(255,255,255,.7);margin-bottom:12px">Dành cho User</div>
                <div style="display:flex;flex-direction:column;gap:8px;font-size:13px">
                    <a href="<?php echo home_url('/dang-ky'); ?>" style="color:rgba(255,255,255,.4);text-decoration:none">Đăng ký kiếm tiền</a>
                    <a href="<?php echo home_url('/user'); ?>" style="color:rgba(255,255,255,.4);text-decoration:none">Dashboard</a>
                    <a href="<?php echo home_url('/dieu-khoan'); ?>" style="color:rgba(255,255,255,.4);text-decoration:none">Điều khoản</a>
                </div>
            </div>
            <div>
                <div style="font-weight:700;font-size:13px;color:rgba(255,255,255,.7);margin-bottom:12px">Dành cho Doanh nghiệp</div>
                <div style="display:flex;flex-direction:column;gap:8px;font-size:13px">
                    <a href="<?php echo home_url('/dang-ky?type=customer'); ?>" style="color:rgba(255,255,255,.4);text-decoration:none">Đăng ký mua traffic</a>
                    <a href="<?php echo home_url('/customer'); ?>" style="color:rgba(255,255,255,.4);text-decoration:none">Tạo chiến dịch SEO</a>
                </div>
            </div>
        </div>
    </div>
    <div style="border-top:1px solid rgba(255,255,255,.08);padding-top:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px">
        <p style="font-size:12px">&copy; <?php echo date('Y'); ?> SiteTop.one. All rights reserved.</p>
        <p style="font-size:12px">Traffic User &middot; Keyword Ranking &middot; Real Users</p>
    </div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
