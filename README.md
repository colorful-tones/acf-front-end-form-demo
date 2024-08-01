# ACF Front End form demo

__Fork it, or download the [latest release](https://github.com/colorful-tones/acf-front-end-form-demo/releases), and make it your own!__

## What

A WordPress [child theme](https://developer.wordpress.org/themes/advanced-topics/child-themes/) of the default [TwentyNineteen theme](https://wordpress.org/themes/twentynineteen/).

## Why

Demonstrates using an Advanced Custom Fields (ACF) front end form to allow visitors to submit new recipes. The form is registered with ACF's [`acf_register_form()`](https://www.advancedcustomfields.com/resources/acf_register_form/) to create a new Recipe post type in draft status. The form uses an existing ACF field group for the fields.

Once the user submits the new recipe then an email is triggered to notify the WordPress site user with the details.

## How to use

1. Create a test WordPress site. It is quick and easy with Local.
2. Install and activate the [Advanced Custom Fields (ACF) plugin](https://wordpress.org/plugins/advanced-custom-fields/).
3. [Add the the TwentyNineteen default theme](https://wordpress.org/documentation/article/work-with-themes/#adding-new-themes-using-the-administration-screens).
4. Download the `ttnineteen-child` theme (this repo) and activate it.
5. Create and publish a new page titled "New Recipe" (this will be the final form). Visit the /new-recipe/ page and use the form to submit recipes.

### Resources

- [Create a front end form](https://www.advancedcustomfields.com/resources/create-a-front-end-form/)
- [Using acf_form to create a new post](https://www.advancedcustomfields.com/resources/using-acf_form-to-create-a-new-post/)

Some screenshots of the final demo.