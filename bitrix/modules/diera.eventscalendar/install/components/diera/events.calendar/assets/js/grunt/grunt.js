module.exports = function(grunt){
    grunt.initConfig({
       concat: {
         libs: {
           src: [
             '../src/jscal2.js',
             '../src/unicode-letter.js',
             '../src/underscore.min.js'
           ],
           dest: 'build/libs.concat.js'
         }
       },
       min: {
         app: { src: '../main.js', dest: '../main.min.js' },
         calendar: { src: '../src/calendar.js', dest: '../calendar.min.js' },
         libs: { src: '<%= concat.libs.dest %>', dest: '../libs.min.js'}
       }
    });

    grunt.registerTask('default','concat min');

};
