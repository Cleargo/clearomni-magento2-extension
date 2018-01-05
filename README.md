# CLEAROmni Magento 2 Connector by Cleargo team 01

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
## with below payload
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

### update order status
```
POST /rest/V1/cleargo-clearomni/order/update
```
## body
```
{
  "param":{
   "order_id":"80", //order_id
   "status":"closed_exchange_success" //order_status
 }
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

