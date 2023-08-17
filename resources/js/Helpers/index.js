export function pluralize(count, words) {
	const cases = [2, 0, 1, 1, 1, 2];
	return count + ' ' + words[(count % 100 > 4 && count % 100 < 20) ? 2 : cases[Math.min(count % 10, 5)]];
}

export function partialKeys(obj) {
	return new Proxy(obj, {
		get: function(target, name) {
			let keys = Object.keys(target).filter(key => key.startsWith(name)).sort();
			if (keys.length > 0) {
				return target[keys[0]];
			}
		},
	});
};
