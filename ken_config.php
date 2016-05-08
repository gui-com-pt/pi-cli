<?hh

namespace Ken\Runtime;

task('default', array('update', 'serve'));

desc('Update all dependencies');
task('update', function() {
	println("Updating dependencies");
});

desc('Serve a server on a specific --port');
task('serve', function() {
	println("Updating dependencies");
});