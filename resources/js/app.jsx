import React from "react";
import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';

import DefaultLayout from "./Layouts/DefaultLayout";

createInertiaApp({
	resolve: name => {
		const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
		const page = pages[`./Pages/${name}.jsx`];
		page.default.layout = page.default.layout || (page => <DefaultLayout children={page} />);

		return page;
	},
	title: title => `${title} - Название компании`,
	progress: {
		delay: 0,
		color: '#14538D',
		includeCSS: true,
		showSpinner: false,
	},
	setup({ el, App, props }) {
		el.classList.add('page__wrapper');
		createRoot(el).render(<App {...props} className="page__wrapper" />);
	},
});
