# Generic structure of the pages #

On the top of each page is the banner of the site, and the menu.

At the bottom of each page, the footer presents the owner's informations, thanks, contact ... about anything you want (but not too much, keep it small)

The footer text is editable in the admin area. The menu elements can be enabled/disabled in the admin area.


---


# Public pages #

## Home page ##

Entry point of the website, the home page presents the site thanks to the disclaimer. Are also displayed : the latest news (5), the latest updates (10), and a random photo.

In the admin area:
  * The disclaimer is editable
  * You can change how many latest news are shown, or you can enable/disable the block to be shown at all
  * You can change how many updates are shown, or you can enable/disable the block to be shown at all
  * Configure/Upload the photos to be shown randomly, or to show no photo at all.

## News list (archives) ##

This page simply displays the list of all the news, the latest at the top, and 50 news per page (50 is editable in the admin area)

## Galleries ##

### Gallery tree (left column) ###

The hierachy of galleries, with the current gallery expanded. Click on a gallery to view its page.

### Gallery name & infos (top of the page) ###

Displays the name of current gallery, with a few statistics: gallery's uploader, creation date, number of photos/galleries inside, the number of views.

### Gallery's content (center of the page) ###

Either the list of subgalleries, or the list of photos (thumbnails) inside the current gallery. A gallery cannot contain both photos and subgalleries. Clicking on a subgallery goes to the subgallery's page; clicking on a thumbnail goes to the photo preview page.

### Toolbar ###

Available actions :
  * View the latest galleries aded
  * View the latest photos added
  * Go to the most viewed galleries
  * Go to the most viewed photos
  * Search
  * Download the gallery as a zip file

## Photo preview ##

Shows the preview of a photo (medium size), with stats (uploader, number of views) and links to the next and previous photos in the gallery.

## Links ##

On this page are listed the links to other websites related this site (or not, it's up to you). Each link is made of an icon, a name and a description.

## Guestbook ##

Not much to say. Visitors write what they felt about the site, with smileys and captcha.

## Register ##

Informations needed to register:
  * firstname
  * lastname
  * username (unique, letters and digits)
  * password (4 characters min)
  * email

## Login / Logout ##


---


# Members area #

## Create a gallery ##

Choose the parent gallery in the gallery tree, and choose a name for each language available.

Gallery's name must be unique for the language.

## Updload photos ##

## Change my password ##

Input old password, new one and confirmation (+ captcha ?)


---


# Admin area #

## Manage translations ##

## Edit the site's options ##

### Configuration ###

Available configuration options :
  * Enable/disable
    * Videos
    * Guestbook
    * Registrations
    * Other additional functions
  * List of languages (code + label + icon, only a handful of icons available)
  * Change amount of elements displayed (latest news, latest updates, news per page ...)

### Edit the disclaimer ###

The "disclaimer" is the text displayed on the front page. You need to write one for each language.

### Manage the home page photos ###

Select one or more photos to be displayed randomly on the front page.

## Videos ##

Add (upload), remove, edit videos

## Members ##

## Galleries ##

## Photos ##

## Comments ##

## Links ##

## News ##


---


# Enhancements, Nice-to-have & Other ideas #

### Favorites ###

Add an icon in the galleries toolbar. If you a logged in as a member (or an admin) you can "add a gallery to your favorites". Same thing for the photos.

In the members area, (or somewhere else, maybe next to the username and logout button) an icon points to the list of your favorites.

In the toolbars, add an icon to view the galleries the most added to the favorites.

### Ratings ###

Add an icon in the toolbars, which opens a popup to rate the current gallery/photo. Ratings are 1 to 5 stars.

On the page of each gallery/photo, add the average rating (stars) in the stats.

### Themes ###

Objective: allow to change he site's colors, backgrounds and (some) layouts, such as the menu's position and direction.

Technicals: big refactoring. Add a folder for each theme. In this folder, a class "Theme" (or something else) allows to overrides some existing methods, like echoHeader, echoFooter, or the function that prints the menu (the more functions the merrier). In this folder, also add a css file and an icons folder. The css file will overwrite the default rules, and the icons will be used instead of the default. You only need to add the icons you want to overwrite.

### Carousel ###

Add a carousel on some pages where it makes sense. Home page ? News ? Gallery ? Photo preview ?

### Tags ###

Allow to tag the galleries and the photos.

In the toolbars (or somewhere else), add a link to the tag cloud (simple, text, no flash, no animation).

### Comments ###

Allow the logged members to post comments on the galleries and the photos.

In the admin area, in the comments page, add a section for the galleries comments and one for the photos comments. Allow to edit or delete them.

### Mailing list ###

Quite obvious, but not planned so probably later.
  * Add a small form to allow visitors to register to the mailing list
  * Add an option in the members' informations to be able to register/unregister to the mailing list
  * Add an admin page to manage the mailing list contents and addresses (enable, disable, remove, add)
  * Add a checkbox in the news to allow to send the notification to the mailing list

### Statistics ###

Add a global page (members ? admin ? everyone ?) with the main statistics of the site: (top 10 ? 20 ? 50 ?)
  * most viewed galleries
  * most viewed photos
  * best referrers
  * top downloaded videos
  * unviewed/undownloaded contents

Also a page (or on the same page) with a summary:
  * total clicks on photos
  * total clicks on galleries
  * total video downloads
  * members count

### Tracking ###

Add a tracking mechanism, to save which pages are accessed the most, etc...