const mix = require('laravel-mix');
mix
    .styles([
        'public/adminpanel/assets/plugins/custom/prismjs/prismjs.bundle.css',
        'public/adminpanel/assets/css/style.bundle.css',
        'public/adminpanel/assets/plugins/custom/datatables/datatables.bundle.css',
        'public/adminpanel/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
        'public/adminpanel/assets/css/themes/layout/header/base/light.css',
        'public/adminpanel/assets/css/themes/layout/header/menu/light.css',
        'public/adminpanel/assets/css/themes/layout/brand/light.css',
        'public/adminpanel/assets/css/themes/layout/aside/light.css',
    ], 'public/adminpanel/compiled.css')
    .styles([
        'public/adminpanel/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css',
        'public/adminpanel/assets/css/style.bundle.rtl.css',
        'public/adminpanel/assets/plugins/custom/datatables/datatables.bundle.css',
        'public/adminpanel/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css',
        'public/adminpanel/assets/css/themes/layout/header/base/light.rtl.css',
        'public/adminpanel/assets/css/themes/layout/header/menu/light.rtl.css',
        'public/adminpanel/assets/css/themes/layout/brand/light.rtl.css',
        'public/adminpanel/assets/css/themes/layout/aside/light.rtl.css',
    ], 'public/adminpanel/compiled.rtl.css')

    .scripts([
        'public/adminpanel/assets/plugins/global/plugins.bundle.js',
        'public/adminpanel/assets/plugins/custom/prismjs/prismjs.bundle.js',
        'public/adminpanel/assets/js/scripts.bundle.js',
        'public/adminpanel/assets/plugins/custom/datatables/datatables.bundle.js',
    ], 'public/adminpanel/compiled.js')

    .js('resources/js/app.js', 'public/enduser/app.js')

    .styles([
        'public/enduser/lib/bootstrap/css/bootstrap.min.css',
        'public/enduser/css/templatemo-stand-blog.css',
        'public/enduser/css/owl.css',
    ], 'public/enduser/compiled.css')

    .scripts([
        'public/enduser/lib/jquery/jquery.min.js',
        'public/enduser/lib/bootstrap/js/bootstrap.bundle.min.js',
        'public/enduser/lib/jquery.block-ui/jquery.blockUI.js',
        'public/enduser/lib/sweatalert/sweatalert.js',

        'public/enduser/js/custom.js',
        'public/enduser/js/owl.js',
        'public/enduser/js/slick.js',
        'public/enduser/js/isotope.js',
        'public/enduser/js/accordions.js',
    ], 'public/enduser/compiled.js')

    .options({
        processCssUrls: false,
    })
    .version()
    .sourceMaps()

    ;

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.css$\.scss$/i,
                use: ['style-loader', 'css-loader'],
            },
        ],
    },
});
