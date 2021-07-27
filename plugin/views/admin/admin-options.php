<?php

use Transbank\WooCommerce\WebpayRest\PaymentGateways\WC_Gateway_Transbank_Oneclick_Mall_REST;

if (!defined('ABSPATH')) {
    exit;
}
if (!$showedWelcome) {
    update_site_option('transbank_webpay_rest_showed_welcome_message', true);
}
$webpayPlus = new WC_Gateway_Transbank_Webpay_Plus_REST();
$webpayPlusEnvironment = $webpayPlus->get_option('webpay_rest_environment');
$webpayPlusCommerceCode = $webpayPlus->get_option('webpay_rest_commerce_code');

$oneclick = new WC_Gateway_Transbank_Oneclick_Mall_REST();
$oneclickEnvironment = $oneclick->get_option('environment');
$oneclickCommerceCode = $oneclick->get_option('commerce_code');
$oneclickMaxAmount = $oneclick->get_option('max_amount');

global $transbankPluginData;
if ($transbankPluginData) {
    $pluginVersion = $transbankPluginData['Version'] ?? '0';
}
$trackinfo = [
    'source'            => 'webpay_plus_admin',
    'plugin'            => 'wc',
    'version'           => $pluginVersion ?? null,
    'wpcommerce'        => $webpayPlusCommerceCode,
    'wpenv'             => $webpayPlusEnvironment,
    'oneclickenv'       => $oneclickEnvironment,
    'oneclickcommerce'  => $oneclickCommerceCode,
    'oneclickmaxamount' => $oneclickMaxAmount,
]
?>

<style>
    .woocommerce-save-button.button-primary {
        display: none;
    }
</style>

<?php
if ($environment === \Transbank\Webpay\Options::ENVIRONMENT_INTEGRATION) { ?>
    <div class="info-container" style="display: flex">


        <?php include 'components/info-validacion-webpay-plus-box.php'; ?>
        <?php include 'components/credenciales-box.php'; ?>

    </div>

<?php } ?>

<div class="tbk-box">
    <table class="form-table">
        <?php $this->generate_settings_html(); ?>
    </table>
    <button name="save" class="button-primary woocommerce-save-button tbk-custom-save-button" type="submit" value="<?php _e('Guardar cambios', 'transbank_wc_plugin'); ?>"><?php _e('Guardar cambios', 'transbank_wc_plugin'); ?></button>
</div>

<div id="my-content-id" style="display:none;overflow-y: scroll; max-height: 50vh;">
    <h2>¡Excelente!</h2>
    <img style="float: right; width: 180px; padding: 20px; display: block" src="<?php echo plugins_url('/images/webpay-new.png', dirname(__DIR__)); ?>" alt="">
    <div>
        <p>Ahora que ya tienes el plugin instalado, tu sitio ya está  habilitado para que tus clientes puedan pagar usando Webpay Plus.
            Asegúrate de que tu tienda esté
            <a target="_blank" href="<?php echo admin_url('admin.php?page=wc-settings&tab=general'); ?>">configurada para aceptar pesos chilenos</a>

        </p>
    </div>


    <p>Notarás que el plugin viene configurado en modo Integración, por lo que opera en un ambiente de pruebas, con dinero y tarjetas de prueba.</p>

    <h3>¿Que hago ahora?</h3>
    <p>Verifica que todo funcione correctamente. Realiza algunas compras con tarjetas de crédito y de débito, además de probar con transacciones aprobadas y rechazadas.
        <br>Si todo funciona correctamente, solicita tu llave secreta (Api Key Secret). A continuación te explicamos como.  </p>

    <h3>Documentación</h3>
    <p>Encuentra más detalles y funcionalidades en la <a target="_blank" href="http://transbankdevelopers.cl/plugin/woocommerce/">documentación oficial del plugin</a></p>
    <!--<iframe width="100%" height="315" src="https://www.youtube.com/embed/AB9eh7BTJUE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->

</div>

<a href="#" id="show-welcome-message" style="padding-top: 10px" class="">Ver mensaje de bienvenida nuevamente</a>
<img width="1" height="1" referrerpolicy="origin" style="border-radius: 10px; width: 400px; margin-right: 10px; display: block" src="https://contrata.transbankdevelopers.cl/plugin-info?<?php echo http_build_query($trackinfo); ?>" alt="">

<script>
    (function($) {
        <?php if (!$showedWelcome) { ?>
            openWelcomeMessageTransbankWebpayRest();
        <?php } ?>
        $('#show-welcome-message').click(function() {
            openWelcomeMessageTransbankWebpayRest();
        })
        //window.tb_show('TbkRestModalWelcome', "#TB_inline?&width=600&height=550&inlineId=my-content-id", null);
        function openWelcomeMessageTransbankWebpayRest() {
            let content = $('#my-content-id').clone();
            content.show();
            swal({
                content: content[0],
            });
        }
    })(jQuery);

</script>
<script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm_share", b="https://embed.typeform.com/"; if(!gi.call(d,id)){ js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
