import js from "@eslint/js";
import globals from "globals";
import react from "eslint-plugin-react";
import jest from "eslint-plugin-jest";
import babelParser from "@babel/eslint-parser";

export default [
  js.configs.recommended,

  // fichiers node/config
  {
    files: ["*.config.js", "jest.config.js", "src/setupTests.js"],

    languageOptions: {
      globals: {
        ...globals.node,
      },

      sourceType: "script",
    },
  },

  // tests jest
  {
    files: ["**/*.{test,spec}.{js,jsx}", "**/__tests__/**/*.{js,jsx}"],

    plugins: {
      jest,
    },

    languageOptions: {
      globals: {
        ...globals.jest,
        ...globals.node,
      },
    },

    rules: {
      ...jest.configs.recommended.rules,
    },
  },

  // react app
  {
    files: ["**/*.{js,jsx}"],

    languageOptions: {
      parser: babelParser,

      globals: {
        ...globals.browser,
      },

      parserOptions: {
        requireConfigFile: false,

        babelOptions: {
          presets: ["@babel/preset-react"],
        },

        ecmaVersion: "latest",
        sourceType: "module",

        ecmaFeatures: {
          jsx: true,
        },
      },
    },

    plugins: {
      react,
    },

    settings: {
      react: {
        version: "detect",
      },
    },

    rules: {
      "react/react-in-jsx-scope": "off",
      "react/jsx-uses-vars": "error",

      "no-unused-vars": [
        "error",
        {
          varsIgnorePattern: "React",
        },
      ],
    },
  },
];
