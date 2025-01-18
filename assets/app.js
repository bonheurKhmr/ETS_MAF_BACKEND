import { registerReactControllerComponents } from "@symfony/ux-react";
import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

// Initialization for ES Users
import { Collapse, Dropdown, initTWE, Input, Modal, Ripple } from "tw-elements";
import Flash from "./customers/Flash.js";

initTWE({ Collapse, Dropdown, Input, Modal, Ripple });

registerReactControllerComponents(
  require.context("./react/controllers", true, /\.(j|t)sx?$/)
);

// customer
customElements.define("app-flash", Flash);
