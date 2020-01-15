<?php
/**
 * Created by PhpStorm.
 * User: GCG
 * Date: 28.05.2019
 * Time: 17:20
 */
?>
<form id="contact-form" class="box form-send-mail" action="<?php echo admin_url('admin-ajax.php?action=send_mail'); ?>" method="post">
    <div class="form-view">
        <div class="form-group">
            <label for="inputFirstname"><?php _e('Ваше имя' ,'fira'); ?></label>
            <input type="text" name="client_fio" class="form-control req-field" id="inputFirstname" required>
        </div>
        <div class="form-group">
            <label for="inputTel"><?php _e('Номер телефона','fira'); ?></label>
            <input type="tel" name="client_tel" class="form-control req-field" id="inputTel"  required>
        </div>
        <div class="form-group">
            <label for="inputEmail"><?php _e('Ваш email','fira'); ?></label>
            <input type="email" name="client_mail" class="form-control req-field" id="inputEmail" required>
        </div>
        <div class="form-group">
            <label for="inputSum"><?php _e('Сумма к возврату','fira'); ?></label>
            <input type="number" name="client_sum" class="form-control req-field" id="inputSum" required>
        </div>
        <div class="form-submit">
            <button type="submit" class="btn btn-main mail-btn"><?php _e('Отправить'); ?></button>
        </div>
    </div>
    <div class="form-is-sending">
        <span class="pa-spinner"></span>
    </div>
    <div class="form-is-more">
        <button type="button" class="btn btn-main mail-btn">
            <?php _e('Отправить еще'); ?>
        </button>
    </div>
</form>
