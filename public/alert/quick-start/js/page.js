$(function() {

    // Use CSS3 PIE PHP wrapper
    $.alert.setup({
        defaults: {
            pie: 'php'
        }
    });

    // Events
    $('#page')

        // Code folding
        .on('click', '.button.code', function() {
            $(this)
                .next('pre')
                .stop(true, true)
                .slideToggle(250);
        })

        // Examples
        .on('click', '.button[href^="#demo-"]', function() {
            switch ($(this).attr('href').split('-')[1]) {

                // Alert type
                case 'info':
                    $.alert.open('info', 'Lorem ipsum dolor sit amet');
                    break;
                case 'confirm':
                    $.alert.open('confirm', 'Lorem ipsum dolor sit amet');
                    break;
                case 'warning':
                    $.alert.open('warning', 'Lorem ipsum dolor sit amet');
                    break;
                case 'error':
                    $.alert.open('error', 'Lorem ipsum dolor sit amet');
                    break;
                case 'prompt':
                    $.alert.open('prompt', 'Lorem ipsum dolor sit amet');
                    break;

                // Title
                case 'title':
                    $.alert.open('My title', 'Lorem ipsum dolor sit amet');
                    break;

                // Custom buttons
                case 'buttons':
                    $.alert.open('Lorem ipsum dolor sit amet', {
                        someId: 'Abc',
                        someOtherId: 'Def'
                    });
                    break;

                // Callback
                case 'callback_confirm':
                    $.alert.open('confirm', 'Lorem ipsum dolor sit amet?', function(button) {
                        if (button == 'yes')
                            $.alert.open('You pressed the "Yes" button.');
                        else if (button == 'no')
                            $.alert.open('You pressed the "No" button.');
                        else
                            $.alert.open('Alert was canceled.');
                    });
                    break;

                case 'callback_custom':
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

                case 'callback_prompt':
                    $.alert.open('prompt', 'Lorem ipsum dolor sit amet', function(button, value) {
                        if (button == 'ok')
                            $.alert.open(value || 'No value has been entered');
                    });
            };
            return false;
        });
});