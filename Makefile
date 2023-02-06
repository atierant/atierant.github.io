start:
	bundle exec jekyll serve --watch --livereload

update:
	bundle update

install:
	bundle update --plateform && bundle install
	bundle install
