const HOST = window.location.protocol + "//" + window.location.host + '/inventory-pos/';
const HOST_CONTROLLER = window.location.protocol + "//" + window.location.host + '/inventory-pos/data/controller/';

// const HOST = window.location.protocol + "//" + window.location.host + '/inventory-pos/data/controller/';

const HOST_2 = window.location.protocol + '//' + window.location.host + SYSNAME;

// controllers
const PATH_TO_CONTROLLER = 'data/controller';
const INVOICE_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/InvoiceController.php';
const PRODUCT_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/ProductController.php';
const ALERT_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/AlertController.php';
const CATEGORY_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/CategoryController.php';
const LOGIN_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/LoginController.php';
const USER_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/UserController.php';
const SALES_CONTROLLER = HOST_2 + '/' + PATH_TO_CONTROLLER + '/SalesController.php';