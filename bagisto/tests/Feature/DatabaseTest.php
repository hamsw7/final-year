<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;
use Webkul\Customer\Models\CustomerAddress;
uses(RefreshDatabase::class);
test('it can create and retrieve a customer', function () {
    $customer = Customer::create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
    ]);
    $retrievedCustomer = Customer::find($customer->id);
    expect($retrievedCustomer)->toBeInstanceOf(Customer::class);
    expect($retrievedCustomer->email)->toBe('john.doe@example.com');
});
test('it can create and retrieve an address', function () {
    $customer = Customer::create([
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'email' => 'jane.smith@example.com',
    ]);
    $address = CustomerAddress::create([
        'customer_id' => $customer->id,
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'address' => '123 Main St',
        'city' => 'Addis Ababa',
        'state' => 'Addis Ababa',
        'postcode' => '1000',
        'country' => 'ET',
        'phone' => '+251912345678',
        'use_for_shipping' => true,
        'default_address' => true,
    ]);
    expect(CustomerAddress::find($address->id))->toBeInstanceOf(CustomerAddress::class);
    expect(CustomerAddress::find($address->id)->city)->toBe('Addis Ababa');
});
