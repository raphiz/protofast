# Introduction
Protofast is a very easy to use way to quickly create a mockup HTML website site.
I use this when I'm developing a new HTML layout before I actually implement any
code. This way, the "customer" can see if all functionality is available
before the more effort is put into programming.

So what does Protofast do?
It provides a very basic "template engine". One base template is defined. Each
site declares only the specific html. This is better than copy/paste the first
HTML file and modify it (Because you might change the stylesheet names/ add js
libraries etc.). Protofast is a quick-and-dirty way to solve this simple issue.
However, it provides a couple of "goodies" to make this very primitive process
faster.

The concept is very easy to understand if you checkout the sample project or follow the
quickstart guide (see below). For the sample project, clone this repository, chdir into the
"example_project" directory and run `php -S localhost:8000` you can see it in action.

# Disclaimer
This is not a framework to use in production! Think before use it with clients,
it's not allways a good idea to show it to them, cause they then think you're
done with everything else in an houer or two...

# Requirements
* PHP <= 5.6 (should also work with older versions)

# Quick start
On a unix based system, paste the following commands (curl must be installed):
```bash
  mkdir my_project
  cd my_project
  bash < <(curl -s https://raw.githubusercontent.com/raphiz/protofast/v1.0.0/quickstart.sh)

  # Now run the example and go to https://localhost:8000
  php -S localhost:8000
```

# TODOs:
* Fix TODOs in the code
* write tests
* integrate composer -> RELEASE?
* Add auto builds..
