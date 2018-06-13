## PMPro React Demo

Sample WordPress plugin for setting up a project with Yarn, Webpack, BrowserSync and React. Tailored to creating a wp-admin page, but completely flexible and can be used for themes as well.

Companion blog post: https://deliciousbrains.com/develop-wordpress-plugin-webpack-3-react/

### Getting started

1. Fork repo to your Github account
1. Clone repo to your `wp-content/plugins` folder
1. In `config.json` change the `proxyURL` to match the admin url of the plugin page, `http://pmpro.local/wp-admin/index.php?page=pmpro-react-demo`.
1. In your host WordPress `wp-config.php` file add `define( 'PMPRO_AJAX_BASE', 'http://pmpro.local/wp-json/pmpro/v1' );` and update it to point to your REST API base
1. Modify any WordPress config in `pmpro-react-demo.php`. Rename files/methods/strings as necessary.
1. Activate the plugin in wp-admin
1. Navigate to the the admin url of the plugin page, `http://pmpro.local/wp-admin/index.php?page=pmpro-react-demo`.
1. The page should be blank.
1. Open Terminal.
1. `cd` into your plugin's folder and run `yarn`
1. Run `yarn start` to get Webpack and BrowserSync running
1. Return to your plugin page, `http://pmpro.local/wp-admin/index.php?page=pmpro-react-demo`, you should see your WP Options in an editable table.

### To build for production run:

`yarn build`

A production-ready WordPress plugin will be built in the `pmpro-react-demo-built` folder.
