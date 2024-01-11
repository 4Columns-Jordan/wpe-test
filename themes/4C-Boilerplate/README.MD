# Four Columns Boiler Plate Theme
Welcome to the Four Columns Boiler Plate Theme, please enjoy your stay.  
Continue below for a few house keeping rules then get at it.

## House Keeping
**Since this is a private repo the easiest way to access it is via SSH**  
[Follow this guide on how to do that](https://docs.github.com/en/github/authenticating-to-github/connecting-to-github-with-ssh)  
**DO NOT PUSH TO MASTER UNTIL WE ARE READY FOR A VERSION UPDATE**

## Fix Development behind main
[Here's a handy link](https://stackoverflow.com/questions/34118404/what-i-can-do-to-resolve-1-commit-behind-master)

### To install 4C Boiler Plate Theme and create Local Branch
1.	In Terminal CD in themes folder
2.	In Terminal, git clone git@github.com:4Columns-Jordan/4C-Boilerplate.git
3.	In VS Code, open [THEME]
4.	In VS Code Terminal, run git fetch
5.	In VS Code, go to Source Control, click on 3 dots, click on “Checkout to”, click on “Development Branch”
6.	In VS Code Terminal, run git pull
7.	In VS Code, go to Source Control, click on 3 dots, Branch -> Create Branch (This is to create local branch on computer, only needed first time)


### Before Starting Development in Local Branch
1.  In VS Code, go to Source Control, click on 3 dots, Click on "Checkout To", click on your local branch
2.	In VS Code, go to Source Control, click on 3 dots, click on "Branch”, click on “Merge Branch”, Select "Development Branch"
3.  IN VISUAL STUDIO, INSTALL THE GIT LENS EXTENSION, CAN THEN SEE WHICH BRANCH YOU ARE ON IN BOTTOM LEFT SIDE OF SCREEN

### To Submit Local Branch Changes to Development Branch
1.	In VS Code, go to Source Control
2.	Click on Plus next to “Changes”
3.	Give Commit a descriptive message for change
4.	Click the checkmark above Commit Message
5.	In VS Code, go to Source Control, click on 3 dots, click on “Checkout To”, Click on “Development”
6.	In VS Code Terminal, run git pull
7.  (If Conflicts Exist), go to files, find the files that display a message of “M (Modifed) or “C” (Conflict)
8.	(If Conflicts Exist), If a “M” (Modified) file, nothings needs to be done
9.	(If Conflicts Exist), If a “C” (Conflict file, go to the file and then click on “Accept Both Changes.
10.	(If Conflicts Exist), Click OnPlus Next To Merge Changes
11.	(If Conflicts Exist), Give Commit a descriptive message for change
12.	(If Conflicts Exist), Click the checkmark above Commit Message
13.	In VS Code, go to Source Control, click on 3 dots, Branch -> Merge Branch -> Click on “Local Branch created at beginning
14.	In VS Code, go to Source Control, click on 3 dots, click on Push

From there follow the setps in the [branching out](#branching-out) section.

### Bootstrap Links
The Four Columns Boilerplate comes with bootsrap 5 built in by default. Here are a few useful Bootstrap resources:

- [What is Bootstrap?](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [Breakpoints](https://getbootstrap.com/docs/5.0/layout/breakpoints/)
- [Grid layout](https://getbootstrap.com/docs/5.0/layout/grid/)
- [Flex Utilities](https://getbootstrap.com/docs/5.0/utilities/flex/)

### isOnScreen
Our theme includes a custom JQuery function: 'isOnScreen'. This function checks whether a selected element is currently visible within the viewport of a web page.

To use the function, simply select the desired element using jQuery and call the isOnScreen function on it. For example: jQuery('#main').isOnScreen(). The function will return true if the selected element is within the viewport, and false otherwise.

### Modal Framework
The Four Columns Boilerplate includes a custom-built modal framework. To add the files to your block, enqueue the "FCBP-modal" Script files and styles (They are registered by default, all you have to do is enqueue them by name). The default framework should look like this:

```
<div class="fcbp_modal__overlay" modal-id='1'>
    <div class="fcbp_modal__modal">
        <div class="fcbp_modal__modal_inner">
            hello world
        </div>
        <div tabindex=0 title="Close Modal" class="fcbp_modal__close_out">X</div>
    </div>
</div>
```
Where the modal-id attribute is unique. It can be anything, number, string, post id, page id, etc, as long as it is unique. There are two options to open a modal:

```
<a href="javascript:;" modal-id="1" class="fcbp_modal__open">Open Modal</a>
```
A button with the class 'fcbp_modal__open' and a modal-id attribute with a value that matches the modal-id attribute on the modal. <br/>
OR <br/>
By calling the FCBP__openModal function with the Id of the modal as the first parameter.

Closing the modal is the same, the user can click the element with the 'fcbp_modal__close_out' class (It's a little styled X if used in the default framework), clicking out of the modal, or by pressing the escape key. You can programmatically close the modal with the FCBP__closeModal function, this will close all open modals (why would there be more than one in the first place?).

Feel free to style the modals however necessary, just keep the base classes for the basic styles and javascript to work.

### Animate Number Roll Up
Our theme features an integrated animation utility for rolling up numbers. It's simple to use - just add the class "numberRollUp" (which can be changed in the custom.js file) and the "data-rollTo" attribute with the target number. The animation will commence from 0 and smoothly transition to the number specified in the data attribute.

Example:
```
<p class="numberRollUp" data-rollTo="9999">0</p>
```

### Removing Preview from ACF Blocks
In the event that you want to remove the preivew mode from your block you can add this code to the acf_register_block_type array: 

```
'mode' => 'editor',
'supports' => array('mode' => false),
```

### Function: FCBP__render_acf_block
This function is used to render Advanced Custom Fields (ACF) blocks in your theme. It allows you to display custom blocks with specific attributes and content.

#### Parameters:
* **$block_name**: *String* - The name of the ACF block you want to render.
* **$attrs**: *Array* - An array of ACF fields and their corresponding values.
* **$content**: *String* - The inner content of the block, if applicable.
* **$className**: *String* - Custom class for the block
#### Usage:
To use this function, follow the example below:
```
echo '<div class="postType__header">';
$block_name = 'acf/pagehead';
$atts = array('subtitle_text' => $subTitle);
FCBP__render_acf_block( $block_name, $atts );
echo '</div>';
```

#### Important Notes:
* Make sure you have the required dependencies and libraries installed before using this function.
* You can only call custom ACF blocks, including columns, rows, and others from the Block Library.
* If the block you're using has nested blocks, you can only nest them one level deep.
* Leaving the block_name paramater empty will vardump a list of all available block names
* Use the isRenderedFromFunction variable to check how the block was rendered. (useful for repeaters)

## Landing Page System
The Four Columns Boilerplate theme includes a landing page post type by default. Landing pages can be created using either the Gutenberg editor or custom page templates located in the `/templates/landing_page` directory.

### Creating Pages and Templates:
Landing pages function like regular pages but cannot be nested. You have the flexibility to use standard blocks or custom template files. Template files behave similarly to block files, enabling you to access ACF fields, execute queries, or hard code HTML. To create a new page template, follow these steps:

1. Create a new template file in the `/templates/landing_page` directory.
2. Name the template file using the convention `landing_page-template-name.php`.

All templates in the `/templates/landing_page` directory with the slug "landing_page" (following the WordPress template part naming convention: `slug-name.php`) will be automatically added to the "Landing Page Template" dropdown menu in sentence case. This dropdown only appears when the "Use Template" box is checked. If the "Use Template" box is left unchecked, the page uses the Gutenberg editor to build its content.

### Using Custom Fields:
The Landing Page post type comes with the "Landing Page: Base Template" group by default. Alongside the template selector dropdown, you'll find a new landing page template type option in the ACF location rules. Templates are added automatically when created. This feature allows you to add fields to the landing page based on the selected template. It's recommended that you set the post type to "landing page" ***AND*** the landing page template to your desired template.

### Important Notes:
Here are some essential points to keep in mind:

* You need to refresh the page after setting the template. The actions to get the correct fields run on page load.
* Utilize the `[FCBP__render_acf_block](#Function-FCBP__render_acf_block)` function to construct templates using Gutenberg blocks.
* ACF Field data remains available even if the template is not selected, so name your fields accordingly.
* If an element is used across multiple templates, you can create additional template files in the `landing_page` directory. The landing page dropdown menu only checks for the slug "landing_page."

## FCBL__get_posts_ajax Function
The `FCBL__get_posts_ajax` function is designed to retrieve posts via AJAX requests. It's intended for use with a block and requires specific variables to be configured for its proper operation.

### Usage
To use this function in conjunction with a block, follow these steps:

1. Fill out the following variables:
   - `$postType`: Define the post type you want to retrieve (e.g., `'post'`).
   - `$privateCat`: Assign the category ID for private posts (use `get_cat_ID('private')`).
   - `$postsPerPage`: Set the number of posts to display per page.
   - `$args`: Configure the query arguments based on your requirements. You can adjust parameters such as post type, post status, order, orderby, and more.
2. Populate the `$tempArray` variable with the necessary information you need from each post. You can access fields here as well, but remember to pass the post ID as the second parameter if needed.
3. Uncomment the actions after the function to enable the endpoint for AJAX requests.
For more detailed usage examples, refer to the "ajax posts block."

