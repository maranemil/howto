<?php


 /**
    * @var array
    */
   private $FEED_TYPES = array(
      # XML Feeds
      'offer' => '_POST_OFFER_ONLY_DATA_',                             # Offer
      'order_acknowledgement' => '_POST_ORDER_ACKNOWLEDGEMENT_DATA_',                  # Order
      'order_cancellation' => '_POST_FULFILLMENT_ORDER_CANCELLATION_REQUEST_DATA_', # Order
      'order_fulfillment' => '_POST_ORDER_FULFILLMENT_DATA_',                      # Order
      'product_data' => '_POST_PRODUCT_DATA_',                                # Product
      'product_image' => '_POST_PRODUCT_IMAGE_DATA_',                          # Product
      'product_inventory' => '_POST_INVENTORY_AVAILABILITY_DATA_',                 # Product
      'product_item' => '_POST_ITEM_DATA_',                                   # Product
      'product_override' => '_POST_PRODUCT_OVERRIDES_DATA_',                      # Product
      'product_pricing' => '_POST_PRODUCT_PRICING_DATA_',                        # Product
      'product_relationship' => '_POST_PRODUCT_RELATIONSHIP_DATA_',                   # Product
      'shipping_override' => '_POST_SHIPPING_OVERRIDE_DATA_',                      # Shipping
      'webstore_item' => '_POST_WEBSTORE_ITEM_DATA_',                          # Webstore
      'order_request' => '_POST_FULFILLMENT_ORDER_REQUEST_DATA_', # new
      'order_adjustment_feed' => '_POST_PAYMENT_ADJUSTMENT_DATA_',
      # Flat-File Feeds
      'flat_book' => '_POST_FLAT_FILE_BOOKLOADER_DATA_',                   # Book
      'flat_book_uiee' => '_POST_UIEE_BOOKLOADER_DATA_',                        # Book: Universal Information Exchange Environment
      'flat_product_converge' => '_POST_FLAT_FILE_CONVERGENCE_LISTINGS_DATA_',         # Product: Merging
      'flat_product_data' => '_POST_FLAT_FILE_LISTINGS_DATA_',                     # Product
      'flat_product_inventory' => '_POST_FLAT_FILE_INVLOADER_DATA_',                    # Product
      'flat_product_price_inv' => '_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_',  # Product
      'flat_order_acknowledgement_data' => '_POST_FLAT_FILE_ORDER_ACKNOWLEDGEMENT_DATA_',
      'flat_order_fulfillment' => '_POST_FLAT_FILE_FULFILLMENT_DATA_',
      'flat_order_payment_adjustment' => '_POST_FLAT_FILE_PAYMENT_ADJUSTMENT_DATA_',
   );

   /**
    * @var array
    */
   private $FEED_METHODS = array(
      'offer' => 'xml',
      'order_acknowledgement' => 'xml',
      'order_cancellation' => 'xml',
      'order_fulfillment' => 'xml',
      'product_data' => 'xml',
      'product_image' => 'xml',
      'product_inventory' => 'xml',
      'product_item' => 'xml',
      'product_override' => 'xml',
      'product_pricing' => 'xml',
      'product_relationship' => 'xml',
      'shipping_override' => 'xml',
      'webstore_item' => 'xml',
      'flat_book' => 'flat-file',
      'flat_book_uiee' => 'flat-file',
      'flat_product_converge' => 'flat-file',
      'flat_product_data' => 'flat-file',
      'flat_product_inventory' => 'flat-file',
      'flat_product_price_inv' => 'flat-file',
   );


   /**
    * @var array
    */
   private $PROCESSING_STATUSES = array(
      'cancelled' => '_CANCELLED_',
      'done' => '_DONE_',
      'in_progress' => '_IN_PROGRESS_',
      'submitted' => '_SUBMITTED_'
   );


// Order status can be : Standard orders -> Unshipped, PartiallyShipped, Shipped, Canceled, Unfulfillable
// Order status can be : Pre-orders -> PendingAvailability, Pending, Unshipped, PartiallyShipped, Shipped

 // Shipwire service type


   /**
    * @var array
    */
    private $AmazonShippingLevel = array(
        "Standard" => "GD",
        "Expedited" => "2D",
        "SecondDay" => "2D",
        "NextDay" => "1D",
        "Express" => "1D",
    );
