<?php
interface Account
{
    public function deposit(int $amount);
    public function getBalance(): int;
}
class BankAccount implements Account
{
    /**
     * @var int[]
     */
    private array $transactions = [];

    public function deposit(int $amount)
    {
        $this->transactions[] = $amount;
    }

    public function getBalance(): int
    {
        // this is the heavy part, imagine all the transactions even from
        // years and decades ago must be fetched from a database or web service
        // and the balance must be calculated from it

        return (int) array_sum($this->transactions);
    }
}
class BankAccountProxy extends BankAccount implements Account
{
    private ?int $balance = null;
    public function getBalance(): int
    {
        // because calculating balance is so expensive,
        // the usage of BankAccount::getBalance() is delayed until it really is needed
        // and will not be calculated again for this instance
        if ($this->balance === null) {
            $this->balance = parent::getBalance();
        }
        return $this->balance;
    }
}

  $bankAccount = new BankAccountProxy();
  $bankAccount->deposit(30); // 30

  // this time balance is being calculated
  $bankAccount->getBalance(); // 30

  // inheritance allows for BankAccountProxy to behave to an outsider exactly like ServerBankAccount
  $bankAccount->deposit(50); // 50

  // this time the previously calculated balance is returned again without re-calculating it
  $bankAccount->getBalance(); // 30
