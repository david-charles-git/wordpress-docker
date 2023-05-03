# WordPress with Docker Compose and MySQL

This repository provides a Docker Compose configuration for running a WordPress site along with a MySQL database.

## Requirements

- Docker
- Docker Compose

## Usage

1. Clone this repository to your local machine.
2. In the terminal, navigate to the root directory of the repository.
3. Run the following command to start the containers: `docker-compose up`
4. Visit `http://localhost:8000` in your web browser to access the WordPress site.
5. Follow the WordPress installation prompts to set up your site.

## Gitflow

This repository follows a basic Gitflow for managing changes and releases. The Gitflow consists of the following branches:

- `master` - The production-ready branch that always contains the latest stable release of the application.
- `develop` - The branch that is used for ongoing development of new features and bug fixes.
- `review` - The branch that is used for code review before merging into `develop`.
- `feature/[feature-name]` - The branch that is used for developing a specific feature. These branches are created from and merged back into `develop`.

When working on a new feature or bug fix, create a new branch from `develop` using the naming convention `feature/[feature-name]`. Once the work is completed, create a pull request from the feature branch into the `review` branch for code review. Once the code review is completed and any necessary changes are made, merge the feature branch into `develop`. When ready to release a new version of the application, merge `develop` into `master`.
