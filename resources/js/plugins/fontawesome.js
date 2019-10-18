import Vue from "vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faUser,
  faLock,
  faSignOutAlt,
  faCog,
  faUserTie,
  faSlidersH
} from "@fortawesome/free-solid-svg-icons";

import { faGithub } from "@fortawesome/free-brands-svg-icons";

library.add(
  faUser,
  faLock,
  faSignOutAlt,
  faCog,
  faGithub,
  faUserTie,
  faSlidersH
);

Vue.component("fa", FontAwesomeIcon);
