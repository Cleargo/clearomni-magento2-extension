# CLEAROmni Magento 2 Connector
No Configuration required

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