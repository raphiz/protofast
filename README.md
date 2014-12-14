# Protofast
[![Build Status](https://travis-ci.org/raphiz/protofast.svg?branch=master)](https://travis-ci.org/raphiz/protofast)
[![Dependency Status](https://www.versioneye.com/user/projects/5470c2c8810106a6cc00058d/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5470c2c8810106a6cc00058d)
[![Latest Stable Version](https://poser.pugx.org/raphizim/protofast/version.svg)](https://packagist.org/packages/raphizim/protofast)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/raphiz/protofast/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/raphiz/protofast/?branch=master)
[![Code Climate](https://codeclimate.com/github/raphiz/protofast/badges/gpa.svg)](https://codeclimate.com/github/raphiz/protofast)
[![Test Coverage](https://codeclimate.com/github/raphiz/protofast/badges/coverage.svg)](https://codeclimate.com/github/raphiz/protofast)
## Introduction
Protofast is an easy to use solution to quickly create HTML mockup websites.

Protofast works with PHP >= 5.3 and hhvm.

I use this to design a plain HTML layout before I start to write any code. The projects stakeholder can play around with this prototype and give instant feedback concerning the UI. Experiments with new UI-Concepts are cheap this way. When the final draft is accepted from all parties, the actual implementation begins.

But what does Protofast do?
Protofast provides a very basic "template engine".
One base template is defined. It declares some variables in which each site can put specific values.
For example the page title and the main contents.
This prevents you from copy-paste the first HTML file and modify only some specific parts.
Additionally, Protofast provides a couple of "goodies" to make the development faster and easier.
For example, Protofast automatically includes stylesheets and scripts that are called
similar to the prototype.

The concept is easy to grasp if you take a closer look to the sample project or just follow the
quickstart guide (see below) and start experimenting. For the sample project, clone this repository, chdir into the
"example_project" directory and run `php -S localhost:8000` you can see it in action.
It is highly recommended to take a look in the protofast.php file since not all functionality is  documentated so far.

## Disclaimer
This is not a framework to use in production! Think before use it with clients.
It is not always a good idea to show a HTML Mockup because it implies for normal human
beings that most of the work is already done!

## Quick start
On a Unix based system, paste the following commands (curl must be installed):
```bash
  mkdir my_project
  cd my_project
  bash < <(curl -s https://raw.githubusercontent.com/raphiz/protofast/v1.1.0/quickstart.sh)

  # Now run the example and go to https://localhost:8000
  php -S localhost:8000
```
