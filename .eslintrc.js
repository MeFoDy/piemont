// https://eslint.org/docs/user-guide/configuring

module.exports = {
  root: true,
  parser: 'babel-eslint',
  parserOptions: {
    sourceType: 'module',
    ecmaVersion: 2017
  },
  env: {
    browser: true,
    jquery: true,
    es6: true,
    node: true,
  },
  // required to lint *.vue files
  plugins: [
    'html'
  ],
  // add your custom rules here
  'rules': {
    "array-callback-return": "warn",
    "arrow-body-style": ["warn", "as-needed"],
    "arrow-spacing": ["warn", { "before": true, "after": true }],
    "block-scoped-var": "warn",
    "block-spacing": "warn",
    "comma-dangle": ["warn", {
      "arrays": "always-multiline",
      "objects": "always-multiline",
      "imports": "always-multiline",
      "exports": "always-multiline",
      "functions": "ignore"
    }],
    "comma-spacing": ["warn", { "before": false, "after": true }],
    "comma-style": ["warn", "last"],
    "constructor-super": "warn",
    "curly": ["warn", "multi-line"],
    "guard-for-in": "warn",
    "no-alert": "warn",
    "no-cond-assign": "warn",
    "no-console": "warn",
    "no-const-assign": "warn",
    "no-constant-condition": "warn",
    "no-debugger": "warn",
    "no-dupe-args": "warn",
    "no-dupe-class-members": "warn",
    "no-dupe-keys": "warn",
    "no-duplicate-case": "warn",
    "no-else-return": "warn",
    "no-eval": "warn",
    "no-extra-boolean-cast": "warn",
    "no-extra-semi": "warn",
    "no-fallthrough": "warn",
    "no-func-assign": "warn",
    "no-inner-declarations": "warn",
    "no-invalid-regexp": "warn",
    "no-loop-func": "warn",
    "no-multi-spaces": ["warn" ],
    "no-redeclare": "warn",
    "no-self-assign": "warn",
    "no-self-compare": "warn",
    "no-this-before-super": "warn",
    "no-trailing-spaces": "warn",
    "no-undef-init": "warn",
    "no-undef": "warn",
    "no-unexpected-multiline": "warn",
    "no-unmodified-loop-condition": "warn",
    "no-unneeded-ternary": "warn",
    "no-unreachable": "warn",
    "no-unused-expressions": "warn",
    "no-unused-vars": "warn",
    "no-use-before-define": "off",
    "no-useless-escape": "warn",
    "no-useless-rename": "warn",
    "no-useless-return": "warn",
    "no-var": "warn",
    "nonblock-statement-body-position": ["warn", "beside"],
    "operator-assignment": ["warn", "always"],
    "prefer-arrow-callback": "warn",
    "prefer-const": "warn",
    "prefer-destructuring": ["warn", { "array": true, "object": true }, { "enforceForRenamedProperties": false }],
    "prefer-template": "warn",
    "quotes": ["warn", "double", { "allowTemplateLiterals": true }],
    "require-yield": "warn",
    "rest-spread-spacing": ["warn", "never"],
    "semi-spacing": ["warn", { "before": false, "after": true }],
    "semi": ["warn", "always"],
    "sort-imports": "warn",
    "space-before-function-paren": ["warn", { "anonymous": "never", "named": "never", "asyncArrow": "always" }],
    "template-curly-spacing": ["warn", "always"],
    "valid-typeof": "warn"
  }
}