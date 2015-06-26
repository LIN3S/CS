#!/usr/bin/env bash

if [[ -f bin/phpspec ]]; then
    bin/phpspec run
    if [[ $? != 0 ]]; then
       echo "${RED}✘ PHPSpec has failed - commit aborted${NORMAL}\n\n"
       exit 1
    fi
    echo "${GREEN}✔ The specs successfully passed!${NORMAL}\n\n"
fi
