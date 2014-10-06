<?php

class ThemeOptions {

    public function membership_create_menu() {

        //create new top-level menu
        add_menu_page('Theme Settings', 'Theme Settings', 'administrator', 'membershipfmoptions', array($this, 'membership_settings_page'), 'dashicons-admin-appearance', '1');

        //call register settings function
        add_action( 'admin_init', array($this, 'register_mysettings' ));
    }


    public function register_mysettings() {
        //register our settings
        register_setting( 'membership-settings-group', 'facebook' );
        register_setting( 'membership-settings-group', 'twitter' );
        register_setting( 'membership-settings-group', 'gplus' );
        register_setting( 'membership-settings-group', 'youtube' );
        register_setting( 'membership-settings-group', 'soundcloud' );
        register_setting( 'membership-settings-group', 'ganal');
        register_setting( 'membership-settings-group', 'membershipmail');
    }


    public function membership_settings_page() {
        ?>
    <div class="wrap theme-options">
        <h2>IQ Theme</h2>
        <h3>Settings</h3>

        <form method="post" action="options.php">
            <?php settings_fields( 'membership-settings-group' ); ?>
            <?php do_settings_sections( 'membership-settings-group' ); ?>
            <table class="form-table">

                <tr valign="top">
                    <th scope="row"><i class="icon-facebook"></i> Facebook Page:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="facebook" value="<?php echo get_option('facebook'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><i class="icon-twitter-bird"></i> Twitter Page:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="twitter" value="<?php echo get_option('twitter'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><i class="icon-gplus"></i> Google+ Page:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="gplus" value="<?php echo get_option('gplus'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><i class="icon-youtube"></i> Youtube Page:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="youtube" value="<?php echo get_option('youtube'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><i class="icon-soundcloud"></i> Soundcloud Page:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="soundcloud" value="<?php echo get_option('soundcloud'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><i class="icon-check"></i> Google Analytics:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="ganal" value="<?php echo get_option('ganal'); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><i class="icon-mail"></i> Membership Mail:</th>
                    <td class="social-row"><input class="theme-options-input-text" type="text" name="membershipmail" value="<?php echo get_option('membershipmail'); ?>" /></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>

        </form>
    </div>
        <?php $GADAdminDashboard = New GADAdminDashboard(); $test = $GADAdminDashboard->create_dashboard_placeholder() ?>
    <?php }

}

$ThemeOptions = new ThemeOptions();

add_action('admin_menu', array($ThemeOptions, 'membership_create_menu'));

?>