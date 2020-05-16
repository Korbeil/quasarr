# ✴ Quasarr ✴ <small>(alpha version)</small>

> Heavily inspired by [Bobarr](https://github.com/iam4x/bobarr) written by [iam4x](https://twitter.com/iam4x). Thanks to him for his very cool Typescript version 👏

## What is it?

Quasarr is a all-in-one web application, replacing [Sonarr](https://github.com/Sonarr/Sonarr) & [Radarr](https://github.com/Radarr/Radarr/), to automatically search movies and tv shows across your torrent trackers.

## How it works?

First, we use [TMDB API](developers.themoviedb.org/) for movies/tv shows data.

Then, we [Jackett](https://github.com/Jackett/Jackett) as backend torrent search engine.
Jackett allows you to register credentials for many torrent trackers. 
It exposes an API to let us search across all registred trackers. 
That is what Quasarr uses.

Once we have the wanted torrent, we send it to [transmission](https://github.com/transmission/transmission), thanks to the XML-RPC.

Finally, we monitor the state of torrent regularly. 
When one of them is downloaded, we symlink it to a library directory which can be scanned by your favorite media player like [Plex](https://plex.tv).

## Installation

### Requirements

- Docker
- Python 3.x

## Acknowledgments

I would like to thanks some developers for their incredible work:

- [iam4x](https://github.com/iam4x) for Bobarr
- [Korbeil](https://github.com/Korbeil/) for his work on [JanePHP](https://github.com/janephp/janephp)

