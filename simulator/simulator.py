import requests
import json
import sys


def store_account_details(account_numbers: list) -> None:
    '''
    Function that takes in a list of presumed account numbers, 
    calls the customer account loan API and stores the result in a results textfile.
    '''

    headers = {'Accept': 'application/json',
               'Content-Type': 'application/x-www-form-urlencoded'}

    # Make API calls for each account number and store the results in a text file
    with open('results.txt', 'w') as file:
        for number in account_numbers:
            # change host name based on your docker server service e.g LARAVEL_APP_NAME_webserver
            response = requests.get(
                f"http://dfcu_webserver:80/api/customer/account/{number}/loans", headers=headers)

            data = response.json()
            code = response.status_code

            if code == 200:
                formatted = json.dumps(data['data'][0], indent=4)
                file.write(f"{number}: {formatted}\n\n")
            elif code >= 400 and code < 500:
                file.write(f"{number}: {data['message']}\n\n")

            # other responses not specified above just return the response
            else:
                file.write(f'{data}\n\n')


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
