/***
 * Excerpted from "Mastering Dojo",
 * published by The Pragmatic Bookshelf.
 * Copyrights apply to this code. It may not be used to create training material, 
 * courses, books, articles, and the like. Contact us if you are in doubt.
 * We make no guarantees that this code is fit for any purpose. 
 * Visit http://www.pragmaticprogrammer.com/titles/rgdojo for more book information.
***/
/*
 * Copyright (c) 2000-2008, Vista Information Technologies, Inc.
 * Use, modification, and distribution subject to terms of license.
 */
dojo.provide("obe.test.data.wsoDefinitions.set001");
(function(){
  
  obe.test.data.wsoDefinitions.set001.metadataTypes= {
    root: 0,
    folder: 1,
    demographics: 2
  };
  
  obe.test.data.wsoDefinitions.set001.wsoDefinition= [{
    tid: 2,
    units: "em",
    size: ["51em", "25em"],
    classSet: "crf",
    requirements: [
      "dijit.form.NumberTextBox",
      "dijit.form.CheckBox"],
    children: {
      title: {
        type: "staticText",
        posit: {
          t: "0",
          h: "6em",
          l: "0",
          r: "0"
        },
        classSet: "title",
        q: "tl",
        offset: [".2em", ".2em"],
        text: "Demographics",
        children: {
          protocol: {
            type: "staticTextHPair",
            posit: {
              t: "0em",
              h: "2em",
              lr: "11em",
              rr: "0em",
              wl: "10em",
              wr: "10em"
            },
            classSet: "readOnlyData",
            q: ["cr", "cl"],
            offset: [".2em", 0, ".2em", 0],
            text: ["Prototype:", "VCI-82-2008-GCR"]
          },
          investigator: {
            type: "staticTextHPair",
            posit: {
              t: "2em",
              h: "2em",
              lr: "11em",
              rr: "0em",
              wl: "10em",
              wr: "10em"
            },
            classSet: "readOnlyData",
            q: ["cr", "cl"],
            offset: [".2em", 0, ".2em", 0],
            text: ["Investigator:", "Harris"]
          },
          subject: {
            type: "staticTextHPair",
            posit: {
              t: "4em",
              h: "2em",
              lr: "11em",
              rr: "0em",
              wl: "10em",
              wr: "10em"
            },
            classSet: "readOnlyData",
            q: ["cr", "cl"],
            offset: [".2em", 0, ".2em", 0],
            text: ["Subject:", "KKK:1011.1"]
          }
        }
      },
      dob: {
        type: "staticText",
        posit: {
          t: "7em",
          h: "12em",
          l: "1em",
          w: "12em"
        },
        classSet: "group",
        q: "tl",
        offset: [".2em", ".2em"],
        text: "Date of Birth",
        children: {
          yearLabel: {
            type: "staticText",
            posit: {
              t: "2em",
              h: "3em",
              l: "1em",
              w: "4em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Year:",
            children: {
              year: {
                type: "dijit",
                posit: {
                  t: "1.5em",
                  l: "0",
                  w: "3em"
                },
                classSet: "inputText",
                dijit: "dijit.form.NumberTextBox",
                createArgs: {
                  name: "dobYear",
                  "class": "inputText",
                  value: "",
                  constraints: {min: 1900, max:1990, places:0},
                  promptMessage: "Year must be between 1900 and 1990",
                  invalidMessage: "Invalid birth year."
                }
              }                  
            }
          },              
          monthLabel: {
            type: "staticText",
            posit: {
              t: "2em",
              h: "3em",
              l: "5em",
              w: "3em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Month:",
            children: {
              month: {
                type: "dijit",
                posit: {
                  t: "1.5em",
                  l: "0em",
                  w: "2em"
                },
                classSet: "inputText",
                dijit: "dijit.form.NumberTextBox",
                createArgs: {
                  name: "dobMonth",
                  "class": "inputText",
                  value: "",
                  constraints: {min: 1900, max:1990, places:0},
                  promptMessage: "Year must be between 1900 and 1990",
                  invalidMessage: "Invalid birth year."
                }
              }                  
            }
          },              
          dayLabel: {
            type: "staticText",
            posit: {
              t: "2em",
              h: "3em",
              l: "9em",
              w: "3em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Day:",
            children: {
              day: {
                type: "dijit",
                posit: {
                  t: "1.5em",
                  l: "0em",
                  w: "2em"
                },
                classSet: "inputText",
                dijit: "dijit.form.NumberTextBox",
                createArgs: {
                  name: "dobDay",
                  "class": "inputText",
                  value: "",
                  constraints: {min: 1900, max:1990, places:0},
                  promptMessage: "Year must be between 1900 and 1990",
                  invalidMessage: "Invalid birth year."
                }
              }                  
            }
          }            
        }
      },
      sex: {
        type: "staticText",
        posit: {
          t: "7em",
          h: "12em",
          l: "14em",
          w: "7em"
        },
        classSet: "group",
        q: "tl",
        offset: [".2em", ".2em"],
        text: "Sex",
        children: {
          maleLabel: {
            type: "staticText",
            posit: {
              t: "2em",
              h: "2em",
              l: "1em",
              w: "5em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Male",
            children: {
               male: {
                 type: "dijit",
                 q: "tr",
                 dijit: "dijit.form.RadioButton",
                 createArgs: {
                   checked:"checked",
                   name: "sex",
                   "class": "inputText",
                   value: "1"
                 }
               }
            }
          },
          femaleLabel: {
            type: "staticText",
            posit: {
              t: "4em",
              h: "2em",
              l: "1em",
              w: "5em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Female",
            children: {
               male: {
                 type: "dijit",
                 q: "tr",
                 dijit: "dijit.form.RadioButton",
                 createArgs: {
                   name: "sex",
                   "class": "inputText",
                   value: "2",
                   type: "radio"
                 }
               }
            }
          }
        }
      },
      race: {
        type: "staticText",
        posit: {
          t: "7em",
          h: "12em",
          l: "22em",
          w: "19em"
        },
        classSet: "group",
        q: "tl",
        offset: [".2em", ".2em"],
        text: "Race",
        children: {
          caucasianLabel: {
            type: "staticText",
            posit: {
              t: "2em",
              h: "2em",
              l: "1em",
              w: "7em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Caucasian",
            children: {
              caucasian: {
                type: "dijit",
                q: "tr",
                dijit: "dijit.form.RadioButton",
                createArgs: {
                  name: "race",
                  "class": "inputText",
                  value: "1"
                }
              }
            }
          },
          blackLabel: {
            type: "staticText",
            posit: {
              t: "4em",
              h: "2em",
              l: "1em",
              w: "7em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Black",
            children: {
              black: {
                type: "dijit",
                q: "tr",
                dijit: "dijit.form.RadioButton",
                createArgs: {
                  name: "race",
                  "class": "inputText",
                  value: "2"
                }
              }
            }
          },
          hispanicLabel: {
            type: "staticText",
            posit: {
              t: "6em",
              h: "2em",
              l: "1em",
              w: "7em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Hispanic",
            children: {
              hispanic: {
                type: "dijit",
                q: "tr",
                dijit: "dijit.form.RadioButton",
                createArgs: {
                  name: "race",
                  "class": "inputText",
                  value: "3"
                }
              }
            }
          },
          asianLabel: {
            type: "staticText",
            posit: {
              t: "8em",
              h: "2em",
              l: "1em",
              w: "7em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Asian",
            children: {
              asian: {
                type: "dijit",
                q: "tr",
                dijit: "dijit.form.RadioButton",
                createArgs: {
                  name: "race",
                  "class": "inputText",
                  value: "4"
                }
              }
            }
          },
          otherLabel: {
            type: "staticText",
            posit: {
              t: "10em",
              h: "2em",
              l: "1em",
              w: "7em"
            },
            classSet: "inputTextLabel",
            q: "tl",
            offset: [0, 0],
            text: "Other",
            children: {
              Other: {
                type: "dijit",
                q: "tr",
                dijit: "dijit.form.RadioButton",
                createArgs: {
                  name: "race",
                  "class": "inputText",
                  value: "5"
                }
              }
            }
          },
          otherSpecify: {
            type: "dijit",
            posit: {
              t: "9.2em",
              h: "1.5em",
              l: "8em",
              w: "10em"
            },
            classSet: "inputText",
            dijit: "dijit.form.TextBox",
            createArgs: {
              name: "raceOtherSpecify",
              "class": "inputText",
              value: ""
            }
          }
        }                                                      
      }                    
    }
  }];
})();
