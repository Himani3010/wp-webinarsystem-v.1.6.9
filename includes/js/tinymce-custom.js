/* global tinymce, wpwebinarsystem_shortcode_data */

(function () {
    if (typeof wpwebinarsystem_shortcode_data != 'undefined') {
        tinymce.create('tinymce.plugins.wpwebinarsystem', {
            init: function (ed, url) {
                _wpwebinarsystem_ed = ed;
                ed.addButton('login_register_shortcodes', {
                    type: 'menubutton',
                    menu: [
                        {text: 'Registration Form',
                            menu: wpwebinarsystem_shortcode_data[0]},
                        {text: 'Login Form',
                            menu: wpwebinarsystem_shortcode_data[1]}
                    ],
                    image: url + '/../images/webinarv2.ico'
                });
            }
        });
        tinymce.PluginManager.add("wpwebinarsystem", tinymce.plugins.wpwebinarsystem);
    }
})();