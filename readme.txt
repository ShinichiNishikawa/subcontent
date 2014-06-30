=== Subtitle ===
Contributors: ShinichiN
Tags: sub content, editor, wp_editor, custom field
Requires at least: 3.5.1
Tested up to: 3.9.1
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds another text editor below the editor in your post/page/custom-post-type edit page.

== Description ==

Adds another text editor below the editor in your post/page/custom-post-type edit page.

* [GitHub](https://github.com/ShinichiNishikawa/subcontent)
* [Plugin Homepage](http://nskw-style.com/2013/wordpress/plugin-downloads/subcontent.html)

= Retriving and displaying in templates =

Use `get_the_subcontent()` to retrieve and `the_subcontent()` to display.

= Change label =

By default the label of the input field is "Subtitle". There's a hook for changing it.

`add_filter( 'nskw-sce-meta_label', 'nskw_changesubcontentlabel' );
function nskw_changesubcontentlabel() {
    return 'Contact Information';
}`

= Change the height of the editor =

Default it's 10.

`add_filter( 'nskw-sce-row', 'change_subcontent_row' );
function change_subcontent_row() {
    return 20;
}`

= Hide in particular post type =

`add_filter( 'nskw-sce-post_type', 'nskw_hide_subcontent' );
function nskw_hide_subcontent() {
    return array( 'page', 'newposttype' );
}`

= Disable wpautop =

`add_filter( 'nskw-sce-wpautop', 'nskw_change_wpautop' );
function nskw_change_wpautop() {
    return false;
}`

= No Media Uploader =

`add_filter( 'nskw-sce-media_buttons', 'nskw_change_mediasetting' );
function nskw_change_mediasetting() {
    return false;
}`

= No tinymce =

`add_filter( 'nskw-sce-tinymce', 'nskw_cange_tinymce' );
function nskw_cange_tinymce() {
    return false;
}`

= No shortcode rendering =
`add_filter( 'nskw-sce-shortcode', '__return_false' );`

== Installation ==

1. Upload `subcontent` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

1. Another editor for subcontent appears!

== Changelog ==

0.1 First Release.

0.2 Merged [dcondrey's Pull Request](https://github.com/ShinichiNishikawa/subcontent/commit/2c53a44d1380fa8e271d353af29cf6c245df4406), but changed the order of wpautop and do_shortcode.


