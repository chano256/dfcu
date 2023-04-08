import requests
import json
import sys
import os


def store_account_details(account_numbers: list) -> None:
    '''
    Function that takes in a list of presumed account numbers, 
    calls the customer account loan API and stores the result in a results textfile.
    '''

    headers = {'Accept': 'application/json',
               'Content-Type': 'application/x-www-form-urlencoded'}

    results = ''
    for number in account_numbers:
        # Call the API for each account number and write the results to a file
        # change host name based on your docker server service e.g LARAVEL_APP_NAME_webserver
        response = requests.get(
            f"http://dfcu_webserver:80/api/customer/account/{number}/loans", headers=headers)

        data = response.json()
        code = response.status_code

        # Save the results to a file based on status codes since numbers with errors could be very long
        if code == 200:
            details = data['data'][0] if len(
                data['data']) != 0 else data['data']
            formatted = json.dumps(details, indent=4)
            results += f"{number}: {formatted}\n\n"
        elif code >= 400 and code < 500:
            results += f"{number}: {data['message']}\n\n"

        # other responses not specified above just return the response
        else:
            results += f"{data}\n\n"

    filename = 'results.txt'
    with open(filename, 'w') as file:
        file.write(results)

    print(
        f"Storing results completed successfully. Check Simulator folder for {filename} file")


def validate_user_input(account_numbers) -> list:
    '''
    Validates user input against digits and returns list of numbers.
    '''

    numbers = []
    for num in account_numbers:
        if num.isdigit():
            numbers.append(num)
        else:
            print(f"Invalid account number: {num}")

    return numbers


# Generate a list of presumed account numbers (try 10 digit and non 10 digits as well as letters)
presumed_accounts = input(
    "Enter presumed account numbers separated by a space: ")

account_numbers = validate_user_input(presumed_accounts.split())
# shows users enetered account numbers to store
print(f"Account numbers: {', '.join(account_numbers)}")
store_account_details(account_numbers)
