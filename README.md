# Social media links for October CMS
Manages the social media links that are associated with an October CMS website.

## Manage
Add, edit and delete the social media links via the backend settings page.

## Component
Add the Links component `{% component 'socialMediaLinks' %}` to your CMS page. The component injects the following variables into the page where it's used:
- `linkList` - An array of links with `name`, `url`, `icon` and `is_blank_target` values.
