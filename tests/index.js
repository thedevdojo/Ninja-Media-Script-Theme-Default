casper.test.begin('Test Home Page', 1, function suite(test) {
    casper.start(domain, function() {
        test.assertExists('a.navbar-brand.logo');
    }).run(function() {
        test.done();
    });
});