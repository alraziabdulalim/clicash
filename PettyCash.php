<?php

declare(strict_types=1);
require_once 'app.php';

echo "1.Add Income \n";
echo "2.Add Expense \n";
echo "3.View Transaction \n";
echo "4.View Incomes \n";
echo "5.View Expenses \n";
echo "6.View Balance \n";
echo "7.Create AC Names \n";
echo "8.View AC Names \n";
echo "9.Exit \n";
$input = readline("Chose your option by enter number : ");

if (isset($input)) {

    switch ($input) {
        case 1:
            $amount = readline("Enter income amount : ");
            $acName = readline("Enter income name : ");
            echo createTransaction($amount, $acName, 1);
            break;

        case 2:
            $amount = readline("Enter expense amount : ");
            $acName = readline("Enter income name : ");
            echo createTransaction($amount, $acName, 2);
            break;

        case 3:
            showTransaction(); //show last 5 transaction
            break;

        case 4:
            showAccountTypeTrans(1); //show only debit 5 transaction
            break;

        case 5:
            showAccountTypeTrans(2); //show only credit 5 transaction
            break;

        case 6:
            showBalance();
            break;

        case 7:
            $acName = readline("Enter account name : ");
            echo "1.Income or Debit \n";
            echo "2.Expense or Credit\n";
            $acType = readline("Chose account type by enter number : ");
            echo createAccountName($acName, $acType);
            break;

        case 8:
            echo showAccountName();
            break;

        case 9:
            return;

        default:
            echo "Please enter number (1 to 9) only.\n";
    }
}