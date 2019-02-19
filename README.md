# CLEAROmni Magento 2 Connector by Cleargo team 01

##Authentication
get token if you facing unauth access
detail in here<br />
###Authentication<br />
```http://devdocs.magento.com/guides/v2.1/get-started/authentication/gs-authentication.html```<br />
###Token-based<br />
```http://devdocs.magento.com/guides/v2.1/get-started/authentication/gs-authentication-token.html```<br />
###OAuth-based<br />
```http://devdocs.magento.com/guides/v2.1/get-started/authentication/gs-authentication-oauth.html```<br />

## Product
### Frontlabel
```/rest/V1/cleargo-clearomni/product-attribute/frontendlabels?attribute_code={attribute_code}```

**Example:**
	```/rest/V1/cleargo-clearomni/product-attribute/frontendlabels?attribute_code=image```
	```/rest/V1/cleargo-clearomni/product-attribute/frontendlabels?attribute_code=image,others_attribute_code```

**Response:**
```
[
    {
        "attribute_id": "87",
        "attribute_code": "image",
        "store_id": "1",
        "value": "Size",
        "locale": "en_US"
    }
]
```

### Website Ids - product is available in websites
```/rest/V1/cleargo-clearomni/product/websiteids?sku={sku}```

**Example:**
	```/rest/V1/cleargo-clearomni/product/websiteids?sku=24-MB02```

**Response:**
```
[
    "1",
    "2"
]
```

## Orders
### Order Status
```/rest/V1/cleargo-clearomni/orderstatus```

**Response:**
```
[
    {
        "status": "canceled",
        "label": "Canceled"
    },
    {
        "status": "closed",
        "label": "Closed"
    },
    {
        "status": "complete",
        "label": "Complete"
    },
    {
        "status": "fraud",
        "label": "Suspected Fraud"
    },
    {
        "status": "holded",
        "label": "On Hold"
    },
    {
        "status": "payment_review",
        "label": "Payment Review"
    },
    {
        "status": "paypal_canceled_reversal",
        "label": "PayPal Canceled Reversal"
    },
    {
        "status": "paypal_reversed",
        "label": "PayPal Reversed"
    },
    {
        "status": "pending",
        "label": "Pending"
    },
    {
        "status": "pending_payment",
        "label": "Pending Payment"
    },
    {
        "status": "pending_paypal",
        "label": "Pending PayPal"
    },
    {
        "status": "processing",
        "label": "Processing"
    }
]
```

### get order by id
```
GET    /rest/V1/orders/:id
```
### update quote_item api

## First get the entity_id by item id
```
    GET    /rest/V1/cleargo-clearomni/quoteitem/:quote_item_id
```
## Then use the id retrieved
```
    PUT /rest/V1/cleargo-clearomni/quoteitem/:id
```
## update with below payload
```
{
  "quoteItem":{
    "qty_clearomni_reserved": "12.0000",
    "qty_clearomni_to_transfer": "12.0000",
    "qty_clearomni_cancelled": "12.0000",
    "qty_clearomni_completed": "12.0000",
    "qty_clearomni_refunded": "12.0000",
    "qty_clearomni_exchange_success": "12.0000",
    "qty_clearomni_exchange_rejected": "12.0000"
  }
}
```

### get order by order id
http://aigle.dev4.cleargo.com/rest/V1/orders?searchCriteria[filter_groups][0][filters][0][field]=entity_id& searchCriteria[filter_groups][0][filters][0][value]=:ORDERID& searchCriteria[filter_groups][0][filters][0][condition_type]=eq
## or
http://aigle.dev4.cleargo.com/rest/V1/orders/:ORDERID
## all extra info locate in items->extension_attributes and address->extension_attributes
```
{
  "adjustment_negative": 0,
  "adjustment_positive": 0,
  "applied_rule_ids": "1",
  "base_adjustment_negative": 0,
  "base_adjustment_positive": 0,
  "base_currency_code": "HKD",
  "base_discount_amount": 0,
  "base_discount_invoiced": 0,
  "base_discount_refunded": 0,
  "base_grand_total": 0.8,
  "base_discount_tax_compensation_amount": 0,
  "base_discount_tax_compensation_invoiced": 0,
  "base_discount_tax_compensation_refunded": 0,
  "base_shipping_amount": 0,
  "base_shipping_discount_amount": 0,
  "base_shipping_incl_tax": 0,
  "base_shipping_invoiced": 0,
  "base_shipping_refunded": 0,
  "base_shipping_tax_amount": 0,
  "base_shipping_tax_refunded": 0,
  "base_subtotal": 0.8,
  "base_subtotal_incl_tax": 0.8,
  "base_subtotal_invoiced": 0.8,
  "base_subtotal_refunded": 0.8,
  "base_tax_amount": 0,
  "base_tax_invoiced": 0,
  "base_tax_refunded": 0,
  "base_total_due": 0,
  "base_total_invoiced": 0.8,
  "base_total_invoiced_cost": 0,
  "base_total_online_refunded": 0.8,
  "base_total_paid": 0.8,
  "base_total_refunded": 0.8,
  "base_to_global_rate": 1,
  "base_to_order_rate": 1,
  "billing_address_id": 274,
  "created_at": "2018-02-01 10:43:36",
  "customer_email": "lumiere.chan@cleargo.com",
  "customer_firstname": "lumiere",
  "customer_gender": 0,
  "customer_group_id": 1,
  "customer_id": 1,
  "customer_is_guest": 0,
  "customer_lastname": "chan",
  "customer_note_notify": 1,
  "discount_amount": 0,
  "discount_invoiced": 0,
  "discount_refunded": 0,
  "email_sent": 1,
  "entity_id": 139,
  "global_currency_code": "HKD",
  "grand_total": 0.8,
  "discount_tax_compensation_amount": 0,
  "discount_tax_compensation_invoiced": 0,
  "discount_tax_compensation_refunded": 0,
  "increment_id": "000000077",
  "is_virtual": 0,
  "order_currency_code": "HKD",
  "protect_code": "30a46fd9f54a890c770fcfcb53503df2",
  "quote_id": 388,
  "shipping_amount": 0,
  "shipping_description": "StoreDelivery - Store Delivery",
  "shipping_discount_amount": 0,
  "shipping_discount_tax_compensation_amount": 0,
  "shipping_incl_tax": 0,
  "shipping_invoiced": 0,
  "shipping_refunded": 0,
  "shipping_tax_amount": 0,
  "shipping_tax_refunded": 0,
  "state": "closed",
  "status": "closed_exchange_success",
  "store_currency_code": "HKD",
  "store_id": 1,
  "store_name": "HK Site\nHK Website Store\nEN",
  "store_to_base_rate": 0,
  "store_to_order_rate": 0,
  "subtotal": 0.8,
  "subtotal_incl_tax": 0.8,
  "subtotal_invoiced": 0.8,
  "subtotal_refunded": 0.8,
  "tax_amount": 0,
  "tax_invoiced": 0,
  "tax_refunded": 0,
  "total_due": 0,
  "total_invoiced": 0.8,
  "total_item_count": 1,
  "total_online_refunded": 0.8,
  "total_paid": 0.8,
  "total_qty_ordered": 1,
  "total_refunded": 0.8,
  "updated_at": "2018-02-05 07:08:53",
  "weight": 9,
  "items": [
    {
      "amount_refunded": 0.8,
      "applied_rule_ids": "1",
      "base_amount_refunded": 0.8,
      "base_discount_amount": 0,
      "base_discount_invoiced": 0,
      "base_discount_refunded": 0,
      "base_discount_tax_compensation_amount": 0,
      "base_discount_tax_compensation_invoiced": 0,
      "base_discount_tax_compensation_refunded": 0,
      "base_original_price": 1,
      "base_price": 0.8,
      "base_price_incl_tax": 0.8,
      "base_row_invoiced": 0.8,
      "base_row_total": 0.8,
      "base_row_total_incl_tax": 0.8,
      "base_tax_amount": 0,
      "base_tax_invoiced": 0,
      "base_tax_refunded": 0,
      "created_at": "2018-02-01 10:43:36",
      "discount_amount": 0,
      "discount_invoiced": 0,
      "discount_percent": 0,
      "discount_refunded": 0,
      "free_shipping": 0,
      "discount_tax_compensation_amount": 0,
      "discount_tax_compensation_invoiced": 0,
      "discount_tax_compensation_refunded": 0,
      "is_qty_decimal": 0,
      "is_virtual": 0,
      "item_id": 234,
      "name": "Test config product dont delete",
      "no_discount": 0,
      "order_id": 139,
      "original_price": 1,
      "price": 0.8,
      "price_incl_tax": 0.8,
      "product_id": 6302,
      "product_type": "configurable",
      "qty_canceled": 0,
      "qty_invoiced": 1,
      "qty_ordered": 1,
      "qty_refunded": 1,
      "qty_returned": 0,
      "qty_shipped": 0,
      "quote_item_id": 552,
      "row_invoiced": 0.8,
      "row_total": 0.8,
      "row_total_incl_tax": 0.8,
      "row_weight": 9,
      "sku": "G9768-44",
      "store_id": 1,
      "tax_amount": 0,
      "tax_invoiced": 0,
      "tax_percent": 0,
      "tax_refunded": 0,
      "updated_at": "2018-02-05 07:08:53",
      "weee_tax_applied": "[]",
      "weight": 9,
      "extension_attributes": {
        "qty_clearomni_reserved": 0,
        "qty_clearomni_to_transfer": 0,
        "qty_clearomni_cancelled": 0,
        "qty_clearomni_completed": 0,
        "qty_clearomni_refunded": 0,
        "qty_clearomni_exchange_success": 0,
        "qty_clearomni_exchange_rejected": 0
      }
    },
    {
      "amount_refunded": 0,
      "base_amount_refunded": 0,
      "base_discount_amount": 0,
      "base_discount_invoiced": 0,
      "base_discount_refunded": 0,
      "base_discount_tax_compensation_invoiced": 0,
      "base_discount_tax_compensation_refunded": 0,
      "base_price": 0,
      "base_row_invoiced": 0,
      "base_row_total": 0,
      "base_tax_amount": 0,
      "base_tax_invoiced": 0,
      "base_tax_refunded": 0,
      "created_at": "2018-02-01 10:43:36",
      "discount_amount": 0,
      "discount_invoiced": 0,
      "discount_percent": 0,
      "discount_refunded": 0,
      "free_shipping": 0,
      "discount_tax_compensation_invoiced": 0,
      "discount_tax_compensation_refunded": 0,
      "is_qty_decimal": 0,
      "is_virtual": 0,
      "item_id": 235,
      "locked_do_ship": 1,
      "name": "Test config product dont delete-44",
      "no_discount": 0,
      "order_id": 139,
      "original_price": 0,
      "parent_item_id": 234,
      "price": 0,
      "product_id": 6296,
      "product_type": "simple",
      "qty_canceled": 0,
      "qty_invoiced": 1,
      "qty_ordered": 1,
      "qty_refunded": 1,
      "qty_returned": 0,
      "qty_shipped": 0,
      "quote_item_id": 553,
      "row_invoiced": 0,
      "row_total": 0,
      "row_weight": 0,
      "sku": "G9768-44",
      "store_id": 1,
      "tax_amount": 0,
      "tax_invoiced": 0,
      "tax_percent": 0,
      "tax_refunded": 0,
      "updated_at": "2018-02-05 07:08:53",
      "weight": 9,
      "parent_item": {
        "amount_refunded": 0.8,
        "applied_rule_ids": "1",
        "base_amount_refunded": 0.8,
        "base_discount_amount": 0,
        "base_discount_invoiced": 0,
        "base_discount_refunded": 0,
        "base_discount_tax_compensation_amount": 0,
        "base_discount_tax_compensation_invoiced": 0,
        "base_discount_tax_compensation_refunded": 0,
        "base_original_price": 1,
        "base_price": 0.8,
        "base_price_incl_tax": 0.8,
        "base_row_invoiced": 0.8,
        "base_row_total": 0.8,
        "base_row_total_incl_tax": 0.8,
        "base_tax_amount": 0,
        "base_tax_invoiced": 0,
        "base_tax_refunded": 0,
        "created_at": "2018-02-01 10:43:36",
        "discount_amount": 0,
        "discount_invoiced": 0,
        "discount_percent": 0,
        "discount_refunded": 0,
        "free_shipping": 0,
        "discount_tax_compensation_amount": 0,
        "discount_tax_compensation_invoiced": 0,
        "discount_tax_compensation_refunded": 0,
        "is_qty_decimal": 0,
        "is_virtual": 0,
        "item_id": 234,
        "name": "Test config product dont delete",
        "no_discount": 0,
        "order_id": 139,
        "original_price": 1,
        "price": 0.8,
        "price_incl_tax": 0.8,
        "product_id": 6302,
        "product_type": "configurable",
        "qty_canceled": 0,
        "qty_invoiced": 1,
        "qty_ordered": 1,
        "qty_refunded": 1,
        "qty_returned": 0,
        "qty_shipped": 0,
        "quote_item_id": 552,
        "row_invoiced": 0.8,
        "row_total": 0.8,
        "row_total_incl_tax": 0.8,
        "row_weight": 9,
        "sku": "G9768-44",
        "store_id": 1,
        "tax_amount": 0,
        "tax_invoiced": 0,
        "tax_percent": 0,
        "tax_refunded": 0,
        "updated_at": "2018-02-05 07:08:53",
        "weee_tax_applied": "[]",
        "weight": 9,
        "extension_attributes": {
          "qty_clearomni_reserved": 0,
          "qty_clearomni_to_transfer": 0,
          "qty_clearomni_cancelled": 0,
          "qty_clearomni_completed": 0,
          "qty_clearomni_refunded": 0,
          "qty_clearomni_exchange_success": 0,
          "qty_clearomni_exchange_rejected": 0
        }
      },
      "extension_attributes": {
        "qty_clearomni_reserved": 0,
        "qty_clearomni_to_transfer": 0,
        "qty_clearomni_cancelled": 0,
        "qty_clearomni_completed": 0,
        "qty_clearomni_refunded": 0,
        "qty_clearomni_exchange_success": 0,
        "qty_clearomni_exchange_rejected": 0
      }
    }
  ],
  "billing_address": {
    "address_type": "billing",
    "city": "HK",
    "company": "The ONE",
    "country_id": "HK",
    "email": "lumiere.chan@cleargo.com",
    "entity_id": 274,
    "firstname": "lumiere",
    "lastname": "chan",
    "parent_id": 139,
    "postcode": null,
    "street": [
      "UG 219,The ONE,100 NATHAN ROAD, TSIM SHA TSUI"
    ],
    "telephone": "26644557"
  },
  "payment": {
    "account_status": null,
    "additional_information": [
      "ClickAndReserve"
    ],
    "amount_ordered": 0.8,
    "amount_paid": 0.8,
    "amount_refunded": 0.8,
    "base_amount_ordered": 0.8,
    "base_amount_paid": 0.8,
    "base_amount_refunded": 0.8,
    "base_shipping_amount": 0,
    "base_shipping_captured": 0,
    "base_shipping_refunded": 0,
    "cc_last4": null,
    "entity_id": 139,
    "method": "clickandreserve",
    "parent_id": 139,
    "shipping_amount": 0,
    "shipping_captured": 0,
    "shipping_refunded": 0
  },
  "status_histories": [
    {
      "comment": "Order Status is updated to closed_exchange_success by apiwith below payload{\"order_id\":\"139\",\"status\":\"closed_exchange_success\",\"staff_code\":\"9994\",\"clearomni_remarks\":\"4445\",\"pickup_store\":\"666\",\"pickup_store_label\":\"555\",\"pickup_store_clearomni_id\":\"1\"}",
      "created_at": "2018-02-05 08:40:57",
      "entity_id": 245,
      "entity_name": "order",
      "is_customer_notified": null,
      "is_visible_on_front": 0,
      "parent_id": 139,
      "status": "closed_exchange_success"
    },
    {
      "comment": "Credit memo created by api and change status to closed_exchange_success",
      "created_at": "2018-02-05 07:08:53",
      "entity_id": 244,
      "entity_name": "creditmemo",
      "is_customer_notified": null,
      "is_visible_on_front": 0,
      "parent_id": 139,
      "status": "closed_exchange_success"
    },
    {
      "comment": "We refunded HKD$0.80 offline.",
      "created_at": "2018-02-05 07:08:53",
      "entity_id": 243,
      "entity_name": "creditmemo",
      "is_customer_notified": 1,
      "is_visible_on_front": 0,
      "parent_id": 139,
      "status": "closed"
    },
    {
      "comment": "Order Status is updated to processing by apiwith below payload{\"order_id\":\"139\",\"status\":\"processing\"}",
      "created_at": "2018-02-02 10:26:18",
      "entity_id": 242,
      "entity_name": "order",
      "is_customer_notified": null,
      "is_visible_on_front": 0,
      "parent_id": 139,
      "status": "processing"
    },
    {
      "comment": "Invoice created.",
      "created_at": "2018-02-01 10:43:38",
      "entity_id": 241,
      "entity_name": "invoice",
      "is_customer_notified": 1,
      "is_visible_on_front": 0,
      "parent_id": 139,
      "status": "processing"
    },
    {
      "comment": null,
      "created_at": "2018-02-01 10:43:36",
      "entity_id": 240,
      "entity_name": "order",
      "is_customer_notified": 1,
      "is_visible_on_front": 0,
      "parent_id": 139,
      "status": "processing"
    }
  ],
  "extension_attributes": {
    "customer_group_name": "General",
    "website_id": "1",
    "order_type": "reserve",
    "staff_code": "9994",
    "clearomni_remarks": "4445",
    "customer_group_id": "1",
    "pickup_store": "666",
    "pickup_store_label": "555",
    "pickup_store_clearomni_id": "1",
    "shipping_assignments": [
      {
        "shipping": {
          "address": {
            "address_type": "shipping",
            "city": "HK",
            "company": "The ONE",
            "country_id": "HK",
            "email": "lumiere.chan@cleargo.com",
            "entity_id": 273,
            "firstname": "lumiere",
            "lastname": "chan",
            "parent_id": 139,
            "postcode": null,
            "street": [
              "UG 219,The ONE,100 NATHAN ROAD, TSIM SHA TSUI"
            ],
            "telephone": "26644557"
          },
          "method": "smilestoredelivery_smilestoredelivery",
          "total": {
            "base_shipping_amount": 0,
            "base_shipping_discount_amount": 0,
            "base_shipping_incl_tax": 0,
            "base_shipping_invoiced": 0,
            "base_shipping_refunded": 0,
            "base_shipping_tax_amount": 0,
            "base_shipping_tax_refunded": 0,
            "shipping_amount": 0,
            "shipping_discount_amount": 0,
            "shipping_discount_tax_compensation_amount": 0,
            "shipping_incl_tax": 0,
            "shipping_invoiced": 0,
            "shipping_refunded": 0,
            "shipping_tax_amount": 0,
            "shipping_tax_refunded": 0
          }
        },
        "items": [
          {
            "amount_refunded": 0.8,
            "applied_rule_ids": "1",
            "base_amount_refunded": 0.8,
            "base_discount_amount": 0,
            "base_discount_invoiced": 0,
            "base_discount_refunded": 0,
            "base_discount_tax_compensation_amount": 0,
            "base_discount_tax_compensation_invoiced": 0,
            "base_discount_tax_compensation_refunded": 0,
            "base_original_price": 1,
            "base_price": 0.8,
            "base_price_incl_tax": 0.8,
            "base_row_invoiced": 0.8,
            "base_row_total": 0.8,
            "base_row_total_incl_tax": 0.8,
            "base_tax_amount": 0,
            "base_tax_invoiced": 0,
            "base_tax_refunded": 0,
            "created_at": "2018-02-01 10:43:36",
            "discount_amount": 0,
            "discount_invoiced": 0,
            "discount_percent": 0,
            "discount_refunded": 0,
            "free_shipping": 0,
            "discount_tax_compensation_amount": 0,
            "discount_tax_compensation_invoiced": 0,
            "discount_tax_compensation_refunded": 0,
            "is_qty_decimal": 0,
            "is_virtual": 0,
            "item_id": 234,
            "name": "Test config product dont delete",
            "no_discount": 0,
            "order_id": 139,
            "original_price": 1,
            "price": 0.8,
            "price_incl_tax": 0.8,
            "product_id": 6302,
            "product_type": "configurable",
            "qty_canceled": 0,
            "qty_invoiced": 1,
            "qty_ordered": 1,
            "qty_refunded": 1,
            "qty_returned": 0,
            "qty_shipped": 0,
            "quote_item_id": 552,
            "row_invoiced": 0.8,
            "row_total": 0.8,
            "row_total_incl_tax": 0.8,
            "row_weight": 9,
            "sku": "G9768-44",
            "store_id": 1,
            "tax_amount": 0,
            "tax_invoiced": 0,
            "tax_percent": 0,
            "tax_refunded": 0,
            "updated_at": "2018-02-05 07:08:53",
            "weee_tax_applied": "[]",
            "weight": 9
          },
          {
            "amount_refunded": 0,
            "base_amount_refunded": 0,
            "base_discount_amount": 0,
            "base_discount_invoiced": 0,
            "base_discount_refunded": 0,
            "base_discount_tax_compensation_invoiced": 0,
            "base_discount_tax_compensation_refunded": 0,
            "base_price": 0,
            "base_row_invoiced": 0,
            "base_row_total": 0,
            "base_tax_amount": 0,
            "base_tax_invoiced": 0,
            "base_tax_refunded": 0,
            "created_at": "2018-02-01 10:43:36",
            "discount_amount": 0,
            "discount_invoiced": 0,
            "discount_percent": 0,
            "discount_refunded": 0,
            "free_shipping": 0,
            "discount_tax_compensation_invoiced": 0,
            "discount_tax_compensation_refunded": 0,
            "is_qty_decimal": 0,
            "is_virtual": 0,
            "item_id": 235,
            "locked_do_ship": 1,
            "name": "Test config product dont delete-44",
            "no_discount": 0,
            "order_id": 139,
            "original_price": 0,
            "parent_item_id": 234,
            "price": 0,
            "product_id": 6296,
            "product_type": "simple",
            "qty_canceled": 0,
            "qty_invoiced": 1,
            "qty_ordered": 1,
            "qty_refunded": 1,
            "qty_returned": 0,
            "qty_shipped": 0,
            "quote_item_id": 553,
            "row_invoiced": 0,
            "row_total": 0,
            "row_weight": 0,
            "sku": "G9768-44",
            "store_id": 1,
            "tax_amount": 0,
            "tax_invoiced": 0,
            "tax_percent": 0,
            "tax_refunded": 0,
            "updated_at": "2018-02-05 07:08:53",
            "weight": 9,
            "parent_item": {
              "amount_refunded": 0.8,
              "applied_rule_ids": "1",
              "base_amount_refunded": 0.8,
              "base_discount_amount": 0,
              "base_discount_invoiced": 0,
              "base_discount_refunded": 0,
              "base_discount_tax_compensation_amount": 0,
              "base_discount_tax_compensation_invoiced": 0,
              "base_discount_tax_compensation_refunded": 0,
              "base_original_price": 1,
              "base_price": 0.8,
              "base_price_incl_tax": 0.8,
              "base_row_invoiced": 0.8,
              "base_row_total": 0.8,
              "base_row_total_incl_tax": 0.8,
              "base_tax_amount": 0,
              "base_tax_invoiced": 0,
              "base_tax_refunded": 0,
              "created_at": "2018-02-01 10:43:36",
              "discount_amount": 0,
              "discount_invoiced": 0,
              "discount_percent": 0,
              "discount_refunded": 0,
              "free_shipping": 0,
              "discount_tax_compensation_amount": 0,
              "discount_tax_compensation_invoiced": 0,
              "discount_tax_compensation_refunded": 0,
              "is_qty_decimal": 0,
              "is_virtual": 0,
              "item_id": 234,
              "name": "Test config product dont delete",
              "no_discount": 0,
              "order_id": 139,
              "original_price": 1,
              "price": 0.8,
              "price_incl_tax": 0.8,
              "product_id": 6302,
              "product_type": "configurable",
              "qty_canceled": 0,
              "qty_invoiced": 1,
              "qty_ordered": 1,
              "qty_refunded": 1,
              "qty_returned": 0,
              "qty_shipped": 0,
              "quote_item_id": 552,
              "row_invoiced": 0.8,
              "row_total": 0.8,
              "row_total_incl_tax": 0.8,
              "row_weight": 9,
              "sku": "G9768-44",
              "store_id": 1,
              "tax_amount": 0,
              "tax_invoiced": 0,
              "tax_percent": 0,
              "tax_refunded": 0,
              "updated_at": "2018-02-05 07:08:53",
              "weee_tax_applied": "[]",
              "weight": 9
            }
          }
        ]
      }
    ],
    "gift_cards": [],
    "base_gift_cards_amount": 0,
    "gift_cards_amount": 0,
    "gw_base_price": "0.0000",
    "gw_price": "0.0000",
    "gw_items_base_price": "0.0000",
    "gw_items_price": "0.0000",
    "gw_card_base_price": "0.0000",
    "gw_card_price": "0.0000"
  }
}
```

### update order status
```
POST /rest/V1/cleargo-clearomni/order/update
```
## body
```
{
  "param": {
    "order_id": "128",
    "status": "closed_exchange_success",
    "staff_code": "9994",
    "clearomni_remarks": "4445",
    "pickup_store": "666",
    "pickup_store_label": "555",
    "pickup_store_clearomni_id": "1"
  },
  "items": [
      {
        "order_item_id": "211",
        "qty_clearomni_reserved": "99",
        "qty_clearomni_to_transfer": "99",
        "qty_clearomni_cancelled": "99",
        "qty_clearomni_completed": "99",
        "qty_clearomni_refunded": "99",
        "qty_clearomni_exchange_success": "99",
        "qty_clearomni_exchange_rejected": "99"
      },
      {
        "order_item_id": "210",
        "qty_clearomni_reserved": "991",
        "qty_clearomni_to_transfer": "991",
        "qty_clearomni_cancelled": "991",
        "qty_clearomni_completed": "991",
        "qty_clearomni_refunded": "991",
        "qty_clearomni_exchange_success": "991",
        "qty_clearomni_exchange_rejected": "991"
      }
    ]
}
```
return

## failed
```
{
    "result_data": "",//normally empty all other additional return info will put here
    "result": false,//result is executed successfully?
    "message": "Order Status not exist"//return message
}
```
## success
```
{
        "result_data": "",
        "result": true,
        "message": "Order Status is updated to closed_exchange_success"
}
```



### get Catalog price rule price list
```
GET /rest/V1/cleargo-clearomni/catalogruleprice
```
## body
```
[
    {
        "rule_product_price_id": "1",
        "rule_date": "2019-02-19",
        "customer_group_id": "0",
        "product_id": "22970",
        "rule_price": "32.0000",
        "website_id": "1",
        "latest_start_date": "2019-02-19",
        "earliest_end_date": null
    },
    {
        "rule_product_price_id": "2",
        "rule_date": "2019-02-20",
        "customer_group_id": "0",
        "product_id": "22970",
        "rule_price": "32.0000",
        "website_id": "1",
        "latest_start_date": "2019-02-19",
        "earliest_end_date": null
    }
]
```
