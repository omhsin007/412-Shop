"use strict";

const express = require("express");
const app = express();

app.set("view engine", "pug");

app.get("/", (req, res) => {
  res.render("index", {
    pageTitle: "412 Shop",
    items: [
      { name: "test1", left: 2, image: "1" },
      { name: "test2", left: 1, image: "2" },
      { name: "test3", left: 3, image: "3" },
      { name: "test4", left: 0, image: "4" },
      { name: "test5", left: 5, image: "5" }
    ]
  });
});

app.listen(3000, () => {
  console.log("Server Start on :3000");
});
