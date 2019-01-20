# Contact Us module by Goral

The extension extends Magento® 2 contact us form functionality.
Make possibility manage and reply on consumers' requests.

# Install from GitHub

1. Download zip package by clicking "Clone or Download" and select "Download ZIP" from the dropdown.

2. Create an app/code/Goral/ContactUs directory in your Magento® 2 root folder.

3. Extract the contents from the zip and copy or upload everything to app/code/Goral/ContactUs

4. Run the following commands from the Magento® 2 root folder to install and enable the module:

   ```
   php bin/magento module:enable Goral_ContactUs
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```

5. If Magento® is running in production mode, deploy static content with the following command: 

   ```
   php bin/magento setup:static-content:deploy
   ```