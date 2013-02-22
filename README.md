
CIUnit
=======================

CIUnit is an open source PHPUnit/JUnit like unit testing framework for testing ication developed using CodeIgniter Framework.

Getting Started
---------------



Features
--------

* A
* B


Usage
-----

### API

#### jQuery#typeahead(datasets)

Turns any `input[type="text"]` element into a typeahead. `datasets` is expected to be a single [dataset][datasets] or an array of datasets.

```php
// single dataset
$('input.typeahead-devs').typeahead({
  name: 'accounts',
  local: ['timtrueman', 'JakeHarding', 'vskarich']
});

// multiple datasets
$('input.twitter-search').typeahead([
  {
    name: 'accounts',
    prefetch: 'https://twitter.com/network.json',
    remote: 'https://twitter.com/accounts?q=%QUERY'
  },
  {
    name: 'trends',
    prefetch: 'https://twitter.com/trends.json'
  }
]);
```

#### jQuery.fn.typeahead.configureTransport(options)

Configures the transport component that will be used by typeaheads initialized with the `remote` property set. Once `jQuery#typeahead` is called, this function will not be accessible. Refer to [Transport][transport] for an overview of the transport component along with the details of the configurable options.

```php
$.fn.typeahead.configureTransport({
  debounce: true,
  maxConcurrentRequests: 6
});
```

Bootstrap Integration
---------------------

For simple autocomplete use cases, the typeahead component [Bootstrap][bootstrap] provides should suffice. However, if you'd prefer to take advantage of some of the advance features typeahead.js provides, here's what you'll need to do to integrate typeahead.js with Bootstrap:

* If you're customizing Bootstrap, exclude the typeahead component. If you're depending on the standard *bootstrap.js*, ensure *typeahead.js* is loaded after it.
* The DOM structure of the dropdown menu used by typeahead.js differs from the DOM structure of the Bootstrap dropdown menu. You'll need to load some [additional CSS][typeahead.js-bootstrap.css] in order to get the typeahead.js dropdown menu to fit the default Bootstrap theme.


Issues
------

Have a bug? Please create an issue here on GitHub!

https://github.com/twitter/typeahead/issues



License
-------

Copyright 2013 Agop Seropyan

Licensed under the Apache/BSD License
