# "GraphQL custom Scalar types" package.

## Description

This package contains GraphQL custom Scalar types.  

Available types:  

 - DateTime: format the date as ISO8601.

## Installation

Require the package through composer.

```shell script
composer require marqant-lab/graphql-custom-scalars
```

After this you need to import graphql schema.  
For this add next row to your `graphql/schema.graphql` or `graphql/modules.graphql`:

```graphql
#import ../vendor/marqant-lab/graphql-custom-scalars/graphql/*.graphql
```

## Tests

If you need tests for this package into your project you can add to your phpunit.xml:

```xml
        <testsuite name="MarqantGraphQLDateTimeScalar">
            <directory suffix="Test.php">./vendor/marqant-lab/graphql-custom-scalars/tests</directory>
        </testsuite>
```
