# Gumare Subsystem ESS Description

## Description

This program is designed to assist our Company kassoMart Online Trade Link P.L.C. with data related problems. This is initially and currently being designed as a monitoring system of the kassoMart delivery service for Operators within our company. Assisting them in taking orders and providing feedback for our clients and customers. Gumare Subsystem EES is not designed as an automated solution for orders from our delivery clients rather it is a support system for our managers desecion and our operators.

## MVC Architecture Description

**Model** maps Data coming from the database to the system. **View** is the For correctly generating *content* for the Frontend. Controller controlls how to generate the ***View*** using the system **Model**.

## Use Case Scenarios

#### Create Order
	Description: Customer gives Order to Operator, Operator creates the order based on information provided from the customer.
	Actor: Operator
	Scenrio: 
		1 - Logs in
		2 - Selects Customer from saved custmer data
		3 - Fills Order information
	Extenion: If Customer doesn't exist create a new Customer First
	Precondition: Operator must be signed in

#### Search for Customer
	Description: Operator searches for Customer Details
	Actor: Operator
	Scenario:
		1 - Enters Customer name or phonenumber.
		2 - Selects Customer from list.
		3 - Customer information is displayed 
	Extenion: [NONE]
	Precondition: [NONE]
	
#### Search For Item
	Description: Operator searches for Item
	Actor: Operator
	Scenario:
		1 - Operator enters Item name, tag(s) or catagory
		2 - Operator selects Item
		3 - Item details are displayed
	Extenion: [NONE]
	Precondition: [NONE]

#### Add Item to Cart
	Description: Operator adds Item(s) to Cart a fixed number of times
	Actor: Operator
	Scenario:
		1 - Selects Item
		2 - Enters Item amount
		3 - Adds Item(s) to cart
		4 - Payment Processes Cart price
	Extenion: [NONE]
	Precondition: Item must already be in shop(s), Item must be in stock. 
	
#### Select Shop(s)
	Description: Operator chooses Shop(s) for Order
	Actor: Operator
	Scenario:
		1 - Enter Shop information
		2 - Payment prcosses delivery price from shop location
		3 - Cart Details are re-calculated
	Extension: [NONE]
	Precondition: Item(s) must be in stock in all shops.
	
#### Set Order as being processed
	Description: Operator places Order on Current Shop
	Actor: Operator
	Scenario:
		1 - Select Order
		2 - Set Order as 'being processed'
	Extension: Select 'rejectd' Order and set as being processed
	Precondition: Operator must be 'pending' | 'rejected' to be changed to 'being processed' 

#### List Delivery Worker information
	Description: Operator lists Delivery Worker(s) Information
	Actor: Operator
	Scenario:
		1 - Enter delivery worker information, 
	
	Operator chooses suitable Path from Location Selector
	Operator sets Order as (being) [CashOD]
	Operator sets Order as (being) [Payed]
	Operator sets Order as (being) [Processed]
	Operator sets Order as (being) [Delivered]
	Operator sets Order as (being) [Rejected]
	Operator sets Order as (is) [Delivered]
	Payemnt processes payment details for Order
	SMSService sends message to Customer for Feedback