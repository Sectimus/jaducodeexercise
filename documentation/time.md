# DAY 1
+ Created intitial repository with the remote managed by GitHub.
+ Migrated the provided documentation to be visually represented in the [README.md](/README.md) file.
+ Installed PHP `8.3` on development machine as per Symfony documentation.
+ Installed Composer `2.7.2` on development machine as per Symfony documentation.
+ Installed Symfony CLI `5.8.15` on development machine as optionally recommended by the Symfony documentation.
+ Used the Symfony CLI to initiate the project. I have opted to initate using the webapp version instead of the skeleton version to include a GUI through selfhosted infrastructure.
+ Additionally I have decided to build this project as a docker image that can be run for a more straightforward review.
+ I have added an `entrypoint.sh` script to streamline the setup process and make it easier for dependency management and executing migrations during development, this wouldn't typically be used on start in production.
# DAY 2
+ I started building the route and controller for the Palindrome function
+ I ran into an issue when debugging why the route would not work, the symfony router debugger `php bin/console debug:router` did show my route of `/palindrome/validate` being available on any request method, however it would not route the request to the correct controller, instead resulting in a 404. I thought this may be an issue with the Cache, so I tried clearing to see if that would update the route via `php bin/console cache:clear` but still nothing. Through sleuthing I then found that I may be missing the apache pack composer dependency. The issue still occurred, now I figured it is probably something related with the web server rewriting itself and not nessesarily symfony. Having a dig in the `Dockerfile` I noticed that I added `RUN a2enmod rewrite` but didn't restart the apache server to apply the changes. Adding in `RUN service apache2 restart` let my routes finally come on through.
+ I created the `CheckerService` to implement the required `CheckerInterface` functions of `isPalindrome(...)`, `isAnagram(...)` and `isPangram(...)`
+ I then used dependency injection via symfony autowiring to pull the `CheckerService` through to the constructor of the `CheckerController` and initate it for use.
+ Three seperate branches were then spun off to develop each feature seperately, these were `feature/palindrome`, `feature/anagram` and `feature/pangram`. These will subsequently be merged to `main` when the work is complete.