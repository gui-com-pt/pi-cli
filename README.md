README
====================

Client tool to manage Pi applications

## Usage

Arguments are passed with blank space, optionaly using assingments

hhvm pi help


help
install
update
list
status
remove
publish
dev

## Cache

Pi relies on several info saved in cache like classes attributes
## Install

The installation support a stand alone backend, stand alone frontend or both frontend and backend.

## Update

### Updating third party dependencies

To update NPM or bower dependencies, the files are moved and temporary tries to update to the last versions supported by Pi without breaking.

Unmet dependencies should be resolved persisting versions to those platforms files.