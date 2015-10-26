// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

// Copyright 2006 Google Inc. All Rights Reserved.

/**
 * @fileoverview Definition of the Logger class. Please minimize dependencies
 * this file has on other closure classes as any dependency it takes won't be
 * able to use the logging infrastructure.
 *
 * @see ../demos/debug.html
 */

goog.info.Logger='goog.debug.Logger ... loaded';
goog.provide('goog.debug.LogManager');
goog.provide('goog.debug.Logger');
goog.provide('goog.debug.Logger.Level');

goog.require('goog.array');
goog.require('goog.debug');
goog.require('goog.debug.LogRecord');

/**
 * The Logger is an object used for logging debug messages. Loggers are
 * normally named, using a hierarchical dot-separated namespace. Logger names
 * can be arbitrary strings, but they should normally be based on the package
 * name or class name of the logged component, such as goog.net.BrowserChannel.
 *
 * The Logger object is loosely based on the java class
 * java.util.logging.Logger. It supports different levels of filtering for
 * different loggers.
 *
 * The logger object should never be instantiated by application code. It
 * should always use the goog.debug.Logger.getLogger function.
 *
 * @constructor
 * @param {string} name The name of the Logger.
 */
goog.debug.Logger = function(name) {
  /**
   * Name of the Logger. Generally a dot-separated namespace
   * @type {string}
   * @private
   */
  this.name_ = name;

  /**
   * Parent Logger.
   * @type {goog.debug.Logger?}
   * @private
   */
  this.parent_ = null;

  /**
   * Map of children loggers. The keys are the leaf names of the children and
   * the values are the child loggers.
   * @type {!Object}
   * @private
   */
  this.children_ = {};

  /**
   * Handlers that are listening to this logger.
   * @type {!Array.<Function>}
   * @private
   */
  this.handlers_ = [];
};


/**
 * Level that this logger only filters above. Null indicates it should
 * inherit from the parent.
 * @type {goog.debug.Logger.Level}
 * @private
 */
goog.debug.Logger.prototype.level_ = null;


/**
 * The Level class defines a set of standard logging levels that
 * can be used to control logging output.  The logging Level objects
 * are ordered and are specified by ordered integers.  Enabling logging
 * at a given level also enables logging at all higher levels.
 * <p>
 * Clients should normally use the predefined Level constants such
 * as Level.SEVERE.
 * <p>
 * The levels in descending order are:
 * <ul>
 * <li>SEVERE (highest value)
 * <li>WARNING
 * <li>INFO
 * <li>CONFIG
 * <li>FINE
 * <li>FINER
 * <li>FINEST  (lowest value)
 * </ul>
 * In addition there is a level OFF that can be used to turn
 * off logging, and a level ALL that can be used to enable
 * logging of all messages.
 *
 * @param {string} name The name of the level.
 * @param {number} value The numeric value of the level.
 * @constructor
 */
goog.debug.Logger.Level = function(name, value) {
  /**
   * The name of the level
   * @type {string}
   */
  this.name = name;

  /**
   * The numeric value of the level
   * @type {number}
   */
  this.value = value;
};


/**
 * @return {string} String representation of the logger level.
 */
goog.debug.Logger.Level.prototype.toString = function() {
  return this.name;
};


/**
 * OFF is a special level that can be used to turn off logging.
 * This level is initialized to <CODE>Number.MAX_VALUE</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.OFF =
    new goog.debug.Logger.Level('OFF', Infinity);

/**
 * SHOUT is a message level for extra debugging loudness.
 * This level is initialized to <CODE>1200</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.SHOUT = new goog.debug.Logger.Level('SHOUT', 1200);

/**
 * SEVERE is a message level indicating a serious failure.
 * This level is initialized to <CODE>1000</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.SEVERE = new goog.debug.Logger.Level('SEVERE', 1000);

/**
 * WARNING is a message level indicating a potential problem.
 * This level is initialized to <CODE>900</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.WARNING = new goog.debug.Logger.Level('WARNING', 900);


/**
 * INFO is a message level for informational messages.
 * This level is initialized to <CODE>800</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.INFO = new goog.debug.Logger.Level('INFO', 800);


/**
 * CONFIG is a message level for static configuration messages.
 * This level is initialized to <CODE>700</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.CONFIG = new goog.debug.Logger.Level('CONFIG', 700);


/**
 * FINE is a message level providing tracing information.
 * This level is initialized to <CODE>500</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.FINE = new goog.debug.Logger.Level('FINE', 500);

/**
 * FINER indicates a fairly detailed tracing message.
 * This level is initialized to <CODE>400</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.FINER = new goog.debug.Logger.Level('FINER', 400);

/**
 * FINEST indicates a highly detailed tracing message.
 * This level is initialized to <CODE>300</CODE>.
 * @type {!goog.debug.Logger.Level}
 */

goog.debug.Logger.Level.FINEST = new goog.debug.Logger.Level('FINEST', 300);

/**
 * ALL indicates that all messages should be logged.
 * This level is initialized to <CODE>Number.MIN_VALUE</CODE>.
 * @type {!goog.debug.Logger.Level}
 */
goog.debug.Logger.Level.ALL = new goog.debug.Logger.Level('ALL', 0);


/**
 * The predefined levels.
 * @type {!Array.<!goog.debug.Logger.Level>}
 * @final
 */
goog.debug.Logger.Level.PREDEFINED_LEVELS = [
  goog.debug.Logger.Level.OFF,
  goog.debug.Logger.Level.SHOUT,
  goog.debug.Logger.Level.SEVERE,
  goog.debug.Logger.Level.WARNING,
  goog.debug.Logger.Level.INFO,
  goog.debug.Logger.Level.CONFIG,
  goog.debug.Logger.Level.FINE,
  goog.debug.Logger.Level.FINER,
  goog.debug.Logger.Level.FINEST,
  goog.debug.Logger.Level.ALL];


/**
 * A lookup map used to find the level object based on the name or value of
 * the level object.
 * @type {Object}
 * @private
 */
goog.debug.Logger.Level.predefinedLevelsCache_ = null;


/**
 * Creates the predefined levels cache and populates it.
 * @private
 */
goog.debug.Logger.Level.createPredefinedLevelsCache_ = function() {
  goog.debug.Logger.Level.predefinedLevelsCache_ = {};
  for (var i = 0, level; level = goog.debug.Logger.Level.PREDEFINED_LEVELS[i];
       i++) {
    goog.debug.Logger.Level.predefinedLevelsCache_[level.value] = level;
    goog.debug.Logger.Level.predefinedLevelsCache_[level.name] = level;
  }
};


/**
 * Gets the predefined level with the given name.
 * @param {string} name The name of the level.
 * @return {goog.debug.Logger.Level} The level, or null if none found.
 */
goog.debug.Logger.Level.getPredefinedLevel = function(name) {
  if (!goog.debug.Logger.Level.predefinedLevelsCache_) {
    goog.debug.Logger.Level.createPredefinedLevelsCache_();
  }

  return goog.debug.Logger.Level.predefinedLevelsCache_[name] || null;
};


/**
 * Gets the highest predefined level <= #value.
 * @param {number} value Level value.
 * @return {goog.debug.Logger.Level} The level, or null if none found.
 */
goog.debug.Logger.Level.getPredefinedLevelByValue = function(value) {
  if (!goog.debug.Logger.Level.predefinedLevelsCache_) {
    goog.debug.Logger.Level.createPredefinedLevelsCache_();
  }

  if (value in goog.debug.Logger.Level.predefinedLevelsCache_) {
    return goog.debug.Logger.Level.predefinedLevelsCache_[value];
  }

  for (var i = 0; i < goog.debug.Logger.Level.PREDEFINED_LEVELS.length; ++i) {
    var level = goog.debug.Logger.Level.PREDEFINED_LEVELS[i];
    if (level.value <= value) {
      return level;
    }
  }
  return null;
};


/**
 * Find or create a logger for a named subsystem. If a logger has already been
 * created with the given name it is returned. Otherwise a new logger is
 * created. If a new logger is created its log level will be configured based
 * on the LogManager configuration and it will configured to also send logging
 * output to its parent's handlers. It will be registered in the LogManager
 * global namespace.
 *
 * @param {string} name A name for the logger. This should be a dot-separated
 * name and should normally be based on the package name or class name of the
 * subsystem, such as goog.net.BrowserChannel.
 * @return {!goog.debug.Logger} The named logger.
 */
goog.debug.Logger.getLogger = function(name) {
  return goog.debug.LogManager.getLogger(name);
};


/**
 * Gets the name of this logger.
 * @return {string} The name of this logger.
 */
goog.debug.Logger.prototype.getName = function() {
  return this.name_;
};


/**
 * Adds a handler to the logger. This doesn't use the event system because
 * we want to be able to add logging to the event system.
 * @param {Function} handler Handler function to add.
 */
goog.debug.Logger.prototype.addHandler = function(handler) {
  this.handlers_.push(handler);
};


/**
 * Removes a handler from the logger. This doesn't use the event system because
 * we want to be able to add logging to the event system.
 * @param {Function} handler Handler function to remove.
 * @return {boolean} Whether the handler was removed.
 */
goog.debug.Logger.prototype.removeHandler = function(handler) {
  return goog.array.remove(this.handlers_, handler);
};


/**
 * Returns the parent of this logger.
 * @return {goog.debug.Logger} The parent logger or null if this is the root.
 */
goog.debug.Logger.prototype.getParent = function() {
  return this.parent_;
};


/**
 * Returns the children of this logger as a map of the child name to the logger.
 * @return {!Object} The map where the keys are the child leaf names and the
 *     values are the Logger objects.
 */
goog.debug.Logger.prototype.getChildren = function() {
  return this.children_;
};


/**
 * Set the log level specifying which message levels will be logged by this
 * logger. Message levels lower than this value will be discarded.
 * The level value Level.OFF can be used to turn off logging. If the new level
 * is null, it means that this node should inherit its level from its nearest
 * ancestor with a specific (non-null) level value.
 *
 * @param {goog.debug.Logger.Level} level The new level.
 */
goog.debug.Logger.prototype.setLevel = function(level) {
  this.level_ = level;
};


/**
 * Gets the log level specifying which message levels will be logged by this
 * logger. Message levels lower than this value will be discarded.
 * The level value Level.OFF can be used to turn off logging. If the level
 * is null, it means that this node should inherit its level from its nearest
 * ancestor with a specific (non-null) level value.
 *
 * @return {goog.debug.Logger.Level} The level.
 */
goog.debug.Logger.prototype.getLevel = function() {
  return this.level_;
};


/**
 * Returns the effective level of the logger based on its ancestors' levels.
 * @return {goog.debug.Logger.Level} The level.
 */
goog.debug.Logger.prototype.getEffectiveLevel = function() {
  if (this.level_) {
    return this.level_;
  }
  if (this.parent_) {
    return this.parent_.getEffectiveLevel();
  }
  return null;
};


/**
 * Check if a message of the given level would actually be logged by this
 * logger. This check is based on the Loggers effective level, which may be
 * inherited from its parent.
 * @param {goog.debug.Logger.Level} level The level to check.
 * @return {boolean} Whether the message would be logged.
 */
goog.debug.Logger.prototype.isLoggable = function(level) {
  if (this.level_) {
    return level.value >= this.level_.value;
  }
  if (this.parent_) {
    return this.parent_.isLoggable(level);
  }
  return false;
};


/**
 * Log a message. If the logger is currently enabled for the
 * given message level then the given message is forwarded to all the
 * registered output Handler objects.
 * @param {goog.debug.Logger.Level} level One of the level identifiers.
 * @param {string} msg The string message.
 * @param {Error|Object} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.log = function(level, msg, opt_exception) {
  // java caches the effective level, not sure it's necessary here
  if (this.isLoggable(level)) {
    this.logRecord(this.getLogRecord(level, msg, opt_exception));
  }
};


/**
 * Creates a new log record and adds the exception (if present) to it.
 * @param {goog.debug.Logger.Level} level One of the level identifiers.
 * @param {string} msg The string message.
 * @param {Error|Object} opt_exception An exception associated with the message.
 * @return {!goog.debug.LogRecord} A log record.
 */
goog.debug.Logger.prototype.getLogRecord = function(level, msg, opt_exception) {
  var logRecord = new goog.debug.LogRecord(level, String(msg), this.name_);
  if (opt_exception) {
    logRecord.setException(opt_exception);
    logRecord.setExceptionText(
        goog.debug.exposeException(opt_exception, arguments.callee.caller));
  }
  return logRecord;
};


/**
 * Log a message at the Logger.Level.SHOUT level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.shout = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.SHOUT, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.SEVERE level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.severe = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.SEVERE, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.WARNING level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.warning = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.WARNING, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.INFO level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.info = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.INFO, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.CONFIG level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.config = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.CONFIG, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.FINE level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.fine = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.FINE, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.FINER level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.finer = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.FINER, msg, opt_exception);
};


/**
 * Log a message at the Logger.Level.FINEST level.
 * If the logger is currently enabled for the given message level then the
 * given message is forwarded to all the registered output Handler objects.
 * @param {string} msg The string message.
 * @param {Error} opt_exception An exception associated with the message.
 */
goog.debug.Logger.prototype.finest = function(msg, opt_exception) {
  this.log(goog.debug.Logger.Level.FINEST, msg, opt_exception);
};


/**
 * Log a LogRecord. If the logger is currently enabled for the
 * given message level then the given message is forwarded to all the
 * registered output Handler objects.
 * @param {goog.debug.LogRecord} logRecord A log record to log.
 */
goog.debug.Logger.prototype.logRecord = function(logRecord) {
  if (this.isLoggable(logRecord.getLevel())) {
    var target = this;
    while (target) {
      target.callPublish_(logRecord);
      target = target.getParent();
    }
  }
};


/**
 * Calls the handlers for publish.
 * @param {goog.debug.LogRecord} logRecord The log record to publish.
 * @private
 */
goog.debug.Logger.prototype.callPublish_ = function(logRecord) {
  for (var i = 0; i < this.handlers_.length; i++) {
    this.handlers_[i](logRecord);
  }
};


/**
 * Sets the parent of this logger. This is used for setting up the logger tree.
 * @param {goog.debug.Logger} parent The parent logger.
 * @private
 */
goog.debug.Logger.prototype.setParent_ = function(parent) {
  this.parent_ = parent;
};


/**
 * Adds a child to this logger. This is used for setting up the logger tree.
 * @param {string} name The leaf name of the child.
 * @param {goog.debug.Logger} logger The child logger.
 * @private
 */
goog.debug.Logger.prototype.addChild_ = function(name, logger) {
  this.children_[name] = logger;
};


/**
 * There is a single global LogManager object that is used to maintain a set of
 * shared state about Loggers and log services. This is loosely based on the
 * java class java.util.logging.LogManager.
 *
 */
goog.debug.LogManager = {};

/**
 * Map of logger names to logger objects
 *
 * @type {!Object}
 * @private
 */
goog.debug.LogManager.loggers_ = {};

/**
 * The root logger which is the root of the logger tree.
 * @type {goog.debug.Logger}
 * @private
 */
goog.debug.LogManager.rootLogger_ = null;

/**
 * Initialize the LogManager if not already initialized
 */
goog.debug.LogManager.initialize = function() {
  if (!goog.debug.LogManager.rootLogger_) {
    goog.debug.LogManager.rootLogger_ = new goog.debug.Logger('');
    goog.debug.LogManager.loggers_[''] = goog.debug.LogManager.rootLogger_;
    goog.debug.LogManager.rootLogger_.setLevel(goog.debug.Logger.Level.CONFIG);
  }
};

/**
 * Returns all the loggers
 * @return {!Object} Map of logger names to logger objects.
 */
goog.debug.LogManager.getLoggers = function() {
  return goog.debug.LogManager.loggers_;
};


/**
 * Returns the root of the logger tree namespace, the logger with the empty
 * string as its name
 *
 * @return {!goog.debug.Logger} The root logger.
 */
goog.debug.LogManager.getRoot = function() {
  goog.debug.LogManager.initialize();
  return /** @type {!goog.debug.Logger} */ (goog.debug.LogManager.rootLogger_);
};


/**
 * Method to find a named logger.
 *
 * @param {string} name A name for the logger. This should be a dot-separated
 * name and should normally be based on the package name or class name of the
 * subsystem, such as goog.net.BrowserChannel.
 * @return {!goog.debug.Logger} The named logger.
 */
goog.debug.LogManager.getLogger = function(name) {
  goog.debug.LogManager.initialize();
  if (name in goog.debug.LogManager.loggers_) {
    return goog.debug.LogManager.loggers_[name];
  } else {
    return goog.debug.LogManager.createLogger_(name);
  }
};


/**
 * Creates the named logger. Will also create the parents of the named logger
 * if they don't yet exist.
 * @param {string} name The name of the logger.
 * @return {!goog.debug.Logger} The named logger.
 * @private
 */
goog.debug.LogManager.createLogger_ = function(name) {
  // find parent logger
  var logger = new goog.debug.Logger(name);
  var parts = name.split('.');
  var leafName = parts[parts.length - 1];
  parts.length = parts.length - 1;
  var parentName = parts.join('.');
  var parentLogger = goog.debug.LogManager.getLogger(parentName);

  // tell the parent about the child and the child about the parent
  parentLogger.addChild_(leafName, logger);
  logger.setParent_(parentLogger);

  goog.debug.LogManager.loggers_[name] = logger;
  return logger;
};
























// Hook up checkboxes.
goog.events.listen(goog.dom.$('show_vc'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  vc.setVisible(e.target.checked);
  logger.info((e.target.checked ? 'Showed' : 'Hid') + ' vertical container in ' + (goog.now() - t) + 'ms');
});
goog.events.listen(goog.dom.$('enable_vc'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  vc.setEnabled(e.target.checked);
  // If the container as a whole is disabled, you can't enable/disable
  // child controls.
  goog.dom.$('enable_porthos').disabled = !vc.isEnabled();
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' vertical container in ' + (goog.now() - t) + 'ms');
});
goog.events.listen(goog.dom.$('show_porthos'), goog.events.EventType.CLICK, function (e) {
  vc.getChild('Porthos').setVisible(e.target.checked);
});
goog.events.listen(goog.dom.$('enable_porthos'), goog.events.EventType.CLICK, function (e) {
  vc.getChild('Porthos').setEnabled(e.target.checked);
});
goog.events.listen(goog.dom.$('enable_vc_events'), goog.events.EventType.CLICK, function (e) {
  vc.forEachChild(function (c) {
    if (e.target.checked) {
      // Enable all transition events.
      c.setDispatchTransitionEvents(goog.ui.Component.State.ALL, true);
    } else {
      // Disable all transition events (except for HOVER, which is used
      // by containers internally).
      c.setDispatchTransitionEvents(goog.ui.Component.State.ALL, false);
      c.setDispatchTransitionEvents(goog.ui.Component.State.HOVER, true);
    }
  });
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' state transition events for this container\'s children');
});

// Programmatically create a horizontal container.
var hc = new goog.ui.Container(goog.ui.Container.Orientation.HORIZONTAL);
hc.setId('Horizontal Container');

// Pre-render the container, just to do something different.
hc.render(goog.dom.$('hc'));
goog.array.forEach(['Happy', 'Sleepy', 'Doc', 'Bashful', 'Sneezy', 'Grumpy', 'Dopey'], function (item) {
  var c = new goog.ui.Control(item);
  c.addClassName('goog-inline-block');
  c.setId(item);
  // For demo purposes, have controls dispatch transition events.
  c.setDispatchTransitionEvents(goog.ui.Component.State.ALL, true);
  hc.addChild(c, true);
});
hc.getChild('Doc').setEnabled(false);
goog.events.listen(hc, EVENTS, logEvent);

// Hook up checkboxes.
goog.events.listen(goog.dom.$('show_hc'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  hc.setVisible(e.target.checked);
  logger.info((e.target.checked ? 'Showed' : 'Hid') + ' horizontal container in ' + (goog.now() - t) + 'ms');
});
goog.events.listen(goog.dom.$('enable_hc'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  hc.setEnabled(e.target.checked);
  // If the container as a whole is disabled, you can't enable/disable
  // child controls.
  goog.dom.$('enable_doc').disabled = !hc.isEnabled();
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' horizontal container in ' + (goog.now() - t) + 'ms');
});
goog.events.listen(goog.dom.$('show_doc'), goog.events.EventType.CLICK, function (e) {
  hc.getChild('Doc').setVisible(e.target.checked);
});
goog.events.listen(goog.dom.$('enable_doc'), goog.events.EventType.CLICK, function (e) {
  hc.getChild('Doc').setEnabled(e.target.checked);
});
goog.events.listen(goog.dom.$('enable_hc_events'), goog.events.EventType.CLICK, function (e) {
  hc.forEachChild(function (c) {
    if (e.target.checked) {
      // Enable all transition events.
      c.setDispatchTransitionEvents(goog.ui.Component.State.ALL, true);
    } else {
      // Disable all transition events (except for HOVER, which is used
      // by containers internally).
      c.setDispatchTransitionEvents(goog.ui.Component.State.ALL, false);
      c.setDispatchTransitionEvents(goog.ui.Component.State.HOVER, true);
    }
  });
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' state transition events for this container\'s children');
});

// Programmatically create a non-focusable container.
var nfc = new goog.ui.Container(goog.ui.Container.Orientation.HORIZONTAL);
nfc.setId('NonFocusableContainer');
nfc.setFocusable(false);
goog.array.forEach(['Vicky', 'Cristina', 'Barcelona'], function (item) {
  var c = new goog.ui.Control(item);
  c.setId(item);
  c.addClassName('goog-inline-block');
  // For demo purposes, have controls dispatch transition events.
  c.setDispatchTransitionEvents(goog.ui.Component.State.ALL, true);
  nfc.addChild(c,
  /* opt_render */
  true);
  // Since the container itself is non-focusable, we need to make each
  // child individually focusable; this has to happen *after* addChild().
  // See e.g. bug http://b/1359754.
  c.setSupportedState(goog.ui.Component.State.FOCUSED, true);
});
nfc.render(goog.dom.$('nfc'));
goog.events.listen(nfc, EVENTS, logEvent);

// Programmatically create a toolbar.
var tb = new goog.ui.Container(goog.ui.Container.Orientation.HORIZONTAL);
tb.setId('Toolbar');

// Programmatically create & add toolbar items.
var fontMenu = new goog.ui.Select('Select font');
fontMenu.setId('Font Menu');
fontMenu.setTooltip('Font');
fontMenu.addItem(new goog.ui.Option('Arial', 'Arial, sans-serif'));
fontMenu.addItem(new goog.ui.Option('Courier', 'Courier, monospace'));
fontMenu.addItem(new goog.ui.Option('Times', 'Times, serif'));
fontMenu.addClassName('goog-edit-font');
tb.addChild(fontMenu, true);

var sizeMenu = new goog.ui.Select(null);
sizeMenu.setId('Font Size Menu');
sizeMenu.setTooltip('Font Size');
sizeMenu.addItem(new goog.ui.Option('8pt'));
sizeMenu.addItem(new goog.ui.Option('10pt'));
sizeMenu.addItem(new goog.ui.Option('12pt'));
sizeMenu.addItem(new goog.ui.Option('16pt'));
sizeMenu.setSelectedIndex(1);
sizeMenu.addClassName('goog-edit-font-size');
tb.addChild(sizeMenu, true);

var boldButton = new goog.ui.ToggleButton(goog.dom.createDom('div', 'goog-edit-bold', '\u00A0'));
boldButton.setId('Bold Button');
boldButton.setTooltip('Bold');
tb.addChild(boldButton, true);

var italicButton = new goog.ui.ToggleButton(goog.dom.createDom('div', 'goog-edit-italic', '\u00A0'));
italicButton.setId('Italic Button');
italicButton.setTooltip('Italic');
tb.addChild(italicButton, true);

var underlineButton = new goog.ui.ToggleButton(goog.dom.createDom('div', 'goog-edit-underline', '\u00A0'));
underlineButton.setId('Underline Button');
underlineButton.setTooltip('Underline');
tb.addChild(underlineButton, true);

tb.render(goog.dom.$('tb'));
goog.events.listen(tb, EVENTS, logEvent);

// Hook up checkbox.
goog.events.listen(goog.dom.$('enable_tb'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  tb.setEnabled(e.target.checked);
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' toolbar in ' + (goog.now() - t) + 'ms');
});

var tb2 = new goog.ui.Container();
tb2.decorate(goog.dom.$('tb2'));
goog.events.listen(tb2, EVENTS, logEvent);

// Hook up checkbox.
goog.events.listen(goog.dom.$('enable_tb2'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  tb2.setEnabled(e.target.checked);
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' toolbar in ' + (goog.now() - t) + 'ms');
});

// BiDi container example:
var tb3 = new goog.ui.Container();
tb3.decorate(goog.dom.$('tb3'));
goog.events.listen(tb3, EVENTS, logEvent);

// Hook up checkboxes.
goog.events.listen(goog.dom.$('enable_tb3'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  tb3.setEnabled(e.target.checked);
  logger.info((e.target.checked ? 'Enabled' : 'Disabled') + ' toolbar in ' + (goog.now() - t) + 'ms');
});
goog.events.listen(goog.dom.$('show_tb3'), goog.events.EventType.CLICK, function (e) {
  var t = goog.now();
  tb3.setVisible(e.target.checked);
  logger.info((e.target.checked ? 'Showed' : 'Hid') + ' content element in ' + (goog.now() - t) + 'ms');
});

// Scrolling container.
var tb4 = new goog.ui.Container();
tb4.decorate(goog.dom.$('tb4'));
tb4.setKeyEventTarget(goog.dom.$('tb4_key_target'));
tb4.setFocusable(true);
new goog.ui.ContainerScroller(tb4);

goog.events.listen(goog.dom.$('tb4_highlight_links'), goog.events.EventType.CLICK, function (event) {
  var index = parseInt(event.target.innerHTML, 10);
  if (!isNaN(index)) {
    tb4.getChildAt(index).setHighlighted(true);
  }
});

goog.dom.setTextContent(goog.dom.$('perf'), (goog.now() - timer) + 'ms');


















