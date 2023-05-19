$(function() {

    // Use CSS3 PIE PHP wrapper
    $.alert.setup({
        defaults: {
            pie: 'php'
        }
    });

    // Events
    $(document)

        // Smooth scroll to anchors
        .on('click', 'a[href^="#"]:not([href^="#example"])', function() {
            var $target = $($(this).attr('href'));
            if ($target.length) {
                var top = $target.offset().top;
                $('body, html').animate({scrollTop: top}, 250);
            }
            return false;
        })

        // Examples
        .on('click', 'a[href^="#example"]', function() {
            switch ($(this).attr('href').split('-')[1]) {

                // Usage -------------------------------------------------------

                // Basic usage
                case 'usage_basic_usage_text':
                    $.alert.open('Lorem ipsum dolor sit amet');
                    break;
                case 'usage_basic_usage_html':
                    $.alert.open('<b>Lorem</b> <i>ipsum</i> <u>dolor</u><br /><a href="#">sit amet</a> consectetur.');
                    break;

                // Alert type
                case 'usage_alert_type_info':
                    $.alert.open('info', 'Lorem ipsum dolor sit amet');
                    break;
                case 'usage_alert_type_confirm':
                    $.alert.open('confirm', 'Lorem ipsum dolor sit amet');
                    break;
                case 'usage_alert_type_warning':
                    $.alert.open('warning', 'Lorem ipsum dolor sit amet');
                    break;
                case 'usage_alert_type_error':
                    $.alert.open('error', 'Lorem ipsum dolor sit amet');
                    break;
                case 'usage_alert_type_prompt':
                    $.alert.open('prompt', 'Lorem ipsum dolor sit amet');
                    break;

                // Title
                case 'usage_title':
                    $.alert.open('My title', 'Lorem ipsum dolor sit amet');
                    break;

                // Close icon
                case 'usage_close_icon_cancelable':
                    $.alert.open({
                        type: 'confirm',
                        content: 'Lorem ipsum dolor sit amet',
                        cancel: true
                    });
                    break;
                case 'usage_close_icon_noncancelable':
                    $.alert.open({
                        type: 'confirm',
                        content: 'Lorem ipsum dolor sit amet',
                        cancel: false
                    });
                    break;

                // Icon
                case 'usage_icon_select':
                    $.alert.open({
                        title: 'Alert',
                        icon: 'warning',
                        content: 'Lorem ipsum dolor sit amet'
                    });
                    break;
                case 'usage_icon_hide':
                    $.alert.open({
                        icon: false,
                        content: 'Lorem ipsum dolor sit amet'
                    });
                    break;
                case 'usage_icon_custom':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        icon: 'hand'
                    });
                    break;

                // Width
                case 'usage_width':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        width: 400
                    });
                    break;

                // Content maximum height
                case 'usage_height':
                    $.alert.open('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut egestas ligula ut nunc porttitor dictum. Pellentesque sit amet massa sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris risus lectus, facilisis luctus consectetur dictum, posuere a urna. Curabitur bibendum nisi sem. Nam at lectus at ipsum suscipit consectetur vel at ante. Mauris risus metus, commodo vel volutpat vitae, eleifend nec diam. Nullam tempor tortor ut mi porttitor adipiscing. Curabitur vitae diam sem, sed mattis odio. Pellentesque pretium interdum odio ac tristique. Nunc accumsan mauris et lorem adipiscing vel pulvinar lacus auctor. Fusce euismod, turpis quis elementum interdum, lacus risus porta dui, ac viverra diam augue eu mi. Praesent id lacus sem, eget dictum dui. In scelerisque euismod tellus a tincidunt. Sed sodales ullamcorper viverra. Praesent semper ipsum ac tellus euismod semper bibendum libero lobortis. Vivamus placerat auctor congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi posuere mi vitae arcu aliquet pretium suscipit libero sollicitudin. Vivamus et ligula nisl. Fusce adipiscing porttitor lacus, et luctus dui ornare quis. Pellentesque luctus velit varius turpis egestas posuere. Phasellus et velit metus, at bibendum ante. Vivamus vel enim id est dapibus vestibulum. Nullam tincidunt risus non erat scelerisque cursus ac sed.');
                    break;

                // Content alignment
                case 'usage_content_alignment_left':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        width: 400,
                        align: 'left'
                    });
                    break;
                case 'usage_content_alignment_center':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        width: 400,
                        align: 'center'
                    });
                    break;
                case 'usage_content_alignment_right':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        width: 400,
                        align: 'right'
                    });
                    break;

                // Callback
                case 'usage_callback':
                    $.alert.open('Lorem ipsum dolor sit amet', function() {
                        $.alert.open('This alert was opened from callback!');
                    });
                    break;
                case 'usage_callback_prompt':
                    $.alert.open('prompt', 'Lorem ipsum dolor sit amet', function(button, value) {
                        $.alert.open(value || 'No value has been entered');
                    });
                    break;

                // Buttons
                case 'usage_buttons_define':
                    $.alert.open('Lorem ipsum dolor sit amet', {
                        someId: 'Abc',
                        someOtherId: 'Def'
                    });
                    break;
                case 'usage_buttons_handle1':
                    $.alert.open(
                        'confirm',
                        'Lorem ipsum dolor sit amet',
                        function(button) {
                            if (button == 'yes')
                                $.alert.open('You pressed the "yes" button.');
                            else if (button == 'no')
                                $.alert.open('You pressed the "no" button.');
                            else
                                $.alert.open('Alert was canceled.');
                        }
                    );
                    break;
                case 'usage_buttons_handle2':
                    $.alert.open(
                        'Lorem ipsum dolor sit amet',
                        {
                            A: 'A',
                            B: 'B',
                            C: 'C'
                        },
                        function(button) {
                            if (!button)
                                $.alert.open('Alert was canceled.');
                            else
                                $.alert.open('You pressed the "' + button + '" button.');
                        }
                    );
                    break;

                // Drag&drop
                case 'usage_drag_and_drop_enabled':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        draggable: true
                    });
                    break;
                case 'usage_drag_and_drop_disabled':
                    $.alert.open({
                        content: 'Lorem ipsum dolor sit amet',
                        draggable: false
                    });
                    break;

                // Container
                case 'usage_container':
                    $.alert.open({
                        container: '#example-usage_container',
                        content: 'Lorem ipsum dolor sit amet'
                    });
                    break;

                // Setup -------------------------------------------------------

                // Defaults
                case 'setup_defaults':
                    var backup = $.alert.setup();
                    $.alert.setup({
                        defaults: {
                            type: 'warning',
                            cancel: false
                        }
                    });
                    $.alert.open('Lorem ipsum dolor sit amet', function() {
                        $.alert.setup(backup);
                    });
                    break;

                // Alert types
                case 'setup_alert_types':
                    $.alert.setup({
                        types: {
                            tip: {
                                title: 'Tip',
                                icon: 'tip',
                                buttons: {
                                    cancel: 'Close'
                                }
                            }
                        }
                    });
                    $.alert.open('tip', 'Lorem ipsum dolor sit amet');
                    break;

                // Localization
                case 'setup_localization':
                    var backup = $.alert.setup();
                    $.alert.setup({
                        types: {
                            error: {
                                title: 'Fehler'
                            },
                            warning: {
                                title: 'Warnung'
                            },
                            confirm: {
                                title: 'Konfirmieren',
                                buttons: {
                                    yes: 'Ja',
                                    no: 'Nein'
                                }
                            }
                        }
                    });
                    $.alert.open('confirm', 'Lorem ipsum dolor sit amet', function() {
                        $.alert.setup(backup);
                    });
            };
            return false;
        });
});