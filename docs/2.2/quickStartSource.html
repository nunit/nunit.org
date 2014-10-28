<style><!--
  div.code { width: 34em }
--></style>

<h2>NUnit Quick Start</h2>

<div class="code"><pre class="prettyprint">using System;
using NUnit.Framework;

namespace Bank
{
  public class Account
  {
    private decimal balance;
    private decimal minimumBalance = 10m;

    public void Deposit(decimal amount)
    {
      balance += amount;
    }

    public void Withdraw(decimal amount)
    {
      balance -= amount;
    }

    public void TransferFunds(Account destination, decimal amount)
    {
      if (balance - amount < minimumBalance)
        throw new InsufficientFundsException();

      destination.Deposit(amount);

      Withdraw(amount);
    }

    public decimal Balance
    {
      get { return balance; }
    }

    public decimal MinimumBalance
    {
      get { return minimumBalance; }
    }
  }

  public class InsufficientFundsException : ApplicationException
  {
  }

  [TestFixture]
  public class AccountTest
  {
    Account source;
    Account destination;

    [SetUp]
    public void Init()
    {
      source = new Account();
      source.Deposit(200m);

      destination = new Account();
      destination.Deposit(150m);
    }

    [Test]
    public void TransferFunds()
    {
      source.TransferFunds(destination, 100m);

      Assert.AreEqual(250m, destination.Balance);
      Assert.AreEqual(100m, source.Balance);
    }

    [Test]
    [ExpectedException(typeof(InsufficientFundsException))]
    public void TransferWithInsufficientFunds()
    {
      source.TransferFunds(destination, 300m);
    }

    [Test]
    [Ignore("Decide how to implement transaction management")]
    public void TransferWithInsufficientFundsAtomicity()
    {
      try
      {
        source.TransferFunds(destination, 300m);
      }
      catch (InsufficientFundsException expected)
      {
      }

      Assert.AreEqual(200m, source.Balance);
      Assert.AreEqual(150m, destination.Balance);
    }
  }
}</pre>
</div>
<div style="width: 34em; text-align:center;">
<b>Listing - QuickStart Example</b>
</div>

