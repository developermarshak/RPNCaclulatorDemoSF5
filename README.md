CLI RPN Calculator
=
This this implementation of RPN Calculator by php.


How install it?
-
I hope you have installed required php.
So run `composer install` that's all.


How run calculator?
-
`php ./console calc`


How run tests?
-
`php ./vendor/bin/phpunit ./tests/`


How add other operators?
-
1. You should implement `OperatorInterface`, path: `src/Contract/OperatorInterface.php`, 
see comments for get details requirements of implementation.
 
2. And add this implementation to `.\services.yml` with tag `tag.operator` 
```
  App\Operators\PlusOperator:
    class: App\Operators\PlusOperator
    tags: [app.operator]
```

Reasoning behind this architecture
-

I try not break SOLID principles.
So I don't create dependency not on realization in 95% codes of this application.

I make builder for calculator values stack, for the same reason and because I assume this functionality can be
implemented on other side of the system, for example on frontend side and with database using.

You can replace implementation for other part of current application too.
You should only re-implementing some contract, make test for it (and use current test cases) and change bind for this abstraction in `.\services.yml` 


P.S.
--
1. I don't realized tests for all classes.
I hope current test cases, should be enough for understand my skill. 

2. I really don't sure in `ValueValidator` class, maybe it should be responsibility of OneStepCalculator, but this thing don't like me too.

3. I understand that injected operators to operators collection should be in loading by settings in services.yml, but I can't fast find a solution how do it.