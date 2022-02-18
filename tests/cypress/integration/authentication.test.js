describe('Authentication', () => {
    // beforeEach(() => {
    //     cy.refreshDatabase();
    //     cy.seed();
    // });

    it('signs a user in', () => {
        cy.refreshDatabase();
        cy.seed();

        cy.visit('/login');
        cy.get('#email').type('user@example.com');
        cy.get('#password').type('password');
        cy.get('#login').click();

        cy.contains('since last incident');
    });

    it('denies registration of a disallowed email address domain', () => {
        cy.visit('/register');
        cy.get('#name').type('Not Allowed');
        cy.get('#email').type('denied@example.com');
        cy.get('#password').type('password');
        cy.get('#password_confirmation').type('password');
        cy.contains('button', 'Register').click();

        cy.contains('Email must be a company address');
    });
});
