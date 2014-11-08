Protofast is a very easy to use way to quickly create a mockup site.
I use this when I'm developing a new HTML layout before I actually implement any
code. This way, the "customer" can see if all functionallity is available
before the more effort is put into programming.

So what does protfast do?
It provides a very basic "template engine". One base template is defined. Each
site declares only the specific html. This is better than copy/paste the first
html file and modify it (Because you might change the stylesheet names/ add js
libraries etc.). Protofast is a quick-and-dirty way to solve this simple issue.
However, it provides a couple of "goodies" to make this very primitive process
faster.

The concept is very easy to understand if you checkout the sample project! If you
clone the repo, chdir into the "example_project" directory and run `php -S localhost:8000`
you can see it in action.

This is not a framework to use in production! Think before use it with clients,
it's not allways a good idea to show it to them, cause they then think you're
done with everything else in an houer or two...

# Requirements
* Unix based system (I have no clue if it runs on windows...)
* latest PHP version installed...

# Quick start
```bash
  mkdir my_project
  cd my_project
  bash < <(curl -s https://raw.githubusercontent.com/raphiz/protofast/master/quickstart.sh)

  # Now run the example and go to https://localhost:8000
  php -S localhost:8000

# TODOs:
* Fix TODOs in the code
* write tests
* integrate composer -> RELEASE?
* Add auto builds..
* Use it for turtleweb with inheritance.
