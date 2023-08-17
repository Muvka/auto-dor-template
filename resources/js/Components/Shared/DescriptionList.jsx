import React from 'react';
import clsx from 'clsx';

import DescriptionItem from './DescriptionItem';

const DescriptionList = ({ children = null, className = '' }) => {
	if (!children) {
		return null;
	}

	return (
		<dl className={clsx('description-list', className)}>
			{children}
		</dl>
	);
};

DescriptionList.Item = DescriptionItem;

export default DescriptionList;
