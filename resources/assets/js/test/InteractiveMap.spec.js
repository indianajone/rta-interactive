
describe('Interactive Map', function () {
    var component = require('../components/InteractiveMap');
    it('should have component as google map', function () {
        expect(component.components.googleMap).not.toBe('undefined');
    });
});