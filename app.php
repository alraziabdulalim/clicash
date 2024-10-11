<?php

function createAccountName($acName, $acType)
{
    $accountId = str_replace('.', '', microtime(true));
    $accountName = array(
        'account_id' => $accountId,
        'account_name' => $acName,
        'account_type' => $acType,
    );

    // transaction data to JSON
    $jsonContent = json_encode($accountName);

    $filePath = 'accountName.txt';

    // Open the file in append mode, create it if it doesn't exist
    $file = fopen($filePath, 'a');

    if ($file) {
        fwrite($file, $jsonContent . "\n");
        fclose($file);

        return "<info>Account name add successfully.</info>";
    } else {
        return "<error>Unable to write to file.</error>";
    }
}

function showAccountName()
{
    $filePath = 'transaction.txt';

    $accountNames = array();

    // file reading only
    $file = fopen($filePath, 'r');

    if ($file) {
        // line by line
        while (($line = fgets($file)) !== false) {
            // JSON string to an associative array
            $accountName = json_decode($line, true);

            // transaction matches with account type
            if ($accountName !== null) {
                $accountNames[] = $accountName;
            }
        }
        // file close
        fclose($file);

        // print
        foreach ($accountNames as $accountName) {
            echo $accountName['account_name'] . "\n";
        }
    } else {
        // Return error message if the file could not be opened
        echo "Error: Unable to read from file.";
    }
}

function createTransaction($amount, $acName, $acType)
{
    $transactionId = str_replace('.', '', microtime(true));

    $transaction = array(
        'id' => $transactionId,
        'created_date' => date('Y-m-d H:i:s'),
        'account_name' => $acName,
        'account_type' => $acType,
        'amount' => $amount
    );

    // transaction data to JSON
    $jsonContent = json_encode($transaction);
    $filePath = 'transaction.txt';

    // Open the file in append mode, create it if it doesn't exist
    $file = fopen($filePath, 'a');

    if ($file) {
        fwrite($file, $jsonContent . "\n");
        fclose($file);

        return "<info>Transaction is successful.</info>";
    } else {
        return "<error>Unable to write to file.</error>";
    }
}

function showTransaction()
{
    $filePath = 'transaction.txt';
    $count = 5;

    $transactions = array();

    // file reading only
    $file = fopen($filePath, 'r');

    if ($file) {
        // line by line
        while (($line = fgets($file)) !== false) {
            // JSON string to an associative array
            $transaction = json_decode($line, true);

            // transaction matches with account type
            if ($transaction !== null) {
                $transactions[] = $transaction;
            }
        }
        // file close
        fclose($file);

        // last $count transactions
        $transactions = array_slice($transactions, -$count);

        // print
        foreach ($transactions as $transaction) {
            echo $transaction['created_date'] . " - ";
            echo $transaction['account_name'] . " - ";
            echo $transaction['account_type'] . " - ";
            echo $transaction['amount'] . "\n";
        }
    } else {
        // Return error message if the file could not be opened
        echo "Error: Unable to read from file.";
    }
}
function showAccountTypeTrans($acType)
{
    $filePath = 'transaction.txt';
    $accountType = $acType;
    $count = 5;

    $transactions = array();

    // file reading only
    $file = fopen($filePath, 'r');

    if ($file) {
        // line by line
        while (($line = fgets($file)) !== false) {
            // JSON string to an associative array
            $transaction = json_decode($line, true);

            // transaction matches with account type
            if ($transaction !== null && isset($transaction['account_type']) && $transaction['account_type'] === $accountType) {
                $transactions[] = $transaction;
            }
        }
        // file close
        fclose($file);

        // last $count transactions
        $transactions = array_slice($transactions, -$count);

        // print
        foreach ($transactions as $transaction) {
            echo $transaction['created_date'] . " - ";
            echo $transaction['account_name'] . " - ";
            echo $transaction['amount'] . "\n";
        }
    } else {
        // Return error message if the file could not be opened
        echo "Error: Unable to read from file.";
    }
}
function showBalance()
{
    $filePath = 'transaction.txt';

    $transactions = array();
    $balance = 0;

    // file reading only
    $file = fopen($filePath, 'r');

    if ($file) {
        // line by line
        while (($line = fgets($file)) !== false) {
            // JSON string to an associative array
            $transaction = json_decode($line, true);

            // transaction matches with account type
            if ($transaction !== null) {
                $transactions[] = $transaction;
            }
        }
        // file close
        fclose($file);
        // print
        foreach ($transactions as $transaction) {
            $balance += ($transaction['account_type'] == 1) ? $transaction['amount'] : -($transaction['amount']);
        }
    } else {
        // Return error message if the file could not be opened
        echo "Error: Unable to read from file.";
    }
    echo $balance;
}
?>